<?php 
    if(isset($_GET['id'])){
        $showId = $_GET["id"];
    }
if (!preg_match('/^[0-9]+$/', $showId)) {
    http_response_code(400);
    exit('Invalid TV show ID');
}

// Set this in your hosting environment.
// Do not hardcode your access token in a public file.
$token = 'eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIyNmYzOTcwNGJhOTEwMjlkM2NhZDY3MzQwY2E2ODYwMCIsInN1YiI6IjY2MzZhNzk0OTU5MGUzMDEyM2JjNDlhNSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.ImAuflKe7r_PCIM-jUc8wa9hCTYlwFWQqhQaIXgKVhI';

if (!$token) {
    http_response_code(500);
    exit('TMDB configuration missing');
}

$apiUrl = 'https://api.themoviedb.org/3/tv/' .
          rawurlencode($showId) . '?language=en-US';

$ch = curl_init($apiUrl);

curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
        'accept: application/json',
        'Authorization: Bearer ' . $token
    ],
    CURLOPT_CONNECTTIMEOUT => 5,
    CURLOPT_TIMEOUT => 10
]);

$response = curl_exec($ch);
$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

$show = ($response !== false && $status === 200)
    ? json_decode($response, true)
    : null;

if (!is_array($show) || empty($show['original_name'])) {
    http_response_code(502);
    exit('Unable to retrieve TV show details');
}

function esc($value) {
    return htmlspecialchars(
        (string)$value,
        ENT_QUOTES | ENT_SUBSTITUTE,
        'UTF-8'
    );
}

$title = $show['original_name'];
$description = $show['overview'] ?: 'Watch ' . $title . ' online.';
$poster = !empty($show['backdrop_path'])
    ? 'https://image.tmdb.org/t/p/w1280' . $show['backdrop_path']
    : '';
$url = 'https://streamvibe.lovestoblog.com/watch.php?id=' . $showId;
?>
<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <!-- Basic -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO -->
    <title><?= esc($title) ?></title>

    <meta property="og:type" content="video.other">
    <meta property="og:title" content="<?= esc($title) ?>">
    <meta property="og:description" content="<?= esc($description) ?>">
    <meta property="og:image" content="<?= esc($poster) ?>">
    <meta property="og:url"
          content="https://streamvibe.lovestoblog.com/watch.php?id=<?= rawurlencode($showId) ?>">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= esc($title) ?>">
    <meta name="twitter:description" content="<?= esc($description) ?>">
    <meta name="twitter:image" content="<?= esc($poster) ?>">

  
    <meta name="keywords"
          content="watch TV series online, TV shows, series streaming, watch series, online series, StreamVibe">

    <meta name="author" content="StreamVibe">

    <!-- Search engine behavior -->
    <meta name="robots" content="index, follow, max-image-preview:large">

    <!-- Canonical URL -->
    <link rel="canonical" href="https://streamvibe.lovestoblog.com/">

    <!-- Theme -->
    <meta name="theme-color" content="#0f0f0f">
    <meta name="color-scheme" content="dark">

   
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?= esc($poster) ?>">
    <link rel="apple-touch-icon" href="<?= esc($poster) ?>">

    <!-- Styles -->
    <link rel="stylesheet" href="styles.css">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Tailwind configuration -->
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        background: '#0f0f0f',
                        foreground: '#ffffff',

                        card: '#181818',
                        'card-foreground': '#ffffff',

                        muted: '#262626',
                        'muted-foreground': '#a3a3a3',

                        border: '#303030',

                        primary: '#7c3aed',
                        'primary-foreground': '#ffffff',

                        secondary: '#3b82f6',
                        'secondary-foreground': '#ffffff',

                        accent: '#10b981',
                        'accent-foreground': '#ffffff'
                    }
                }
            }
        }
    </script>

    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.css"
        integrity="sha512-x9WwyMYBnlXMNQ6kQ/Lyzu1NqIhLQKL5Oq6xByfXuRj7s9CskyCbLv/1IjqzJmXwFXWr0ov6jBV7Qbc0hh9nHg=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    >

    <!-- Custom scrollbar -->
    <style>
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>
<body class="min-h-screen bg-background text-foreground font-sans antialiased">    

<div id="loading" class="min-h-screen bg-background flex items-center justify-center">
        <div class="text-center">
          <div class="inline-block h-8 w-8 animate-spin rounded-full border-4 border-muted border-t-primary"></div>
          <p class="mt-4 text-muted-foreground">Loading series...</p>
        </div>
      </div>


      <div id="notfound" class="min-h-screen bg-background flex items-center justify-center">
        <div class="text-center">
          <p class="text-muted-foreground text-lg">Series not found</p>
          <a href="/" class="inline-block mt-4 px-6 py-2 bg-primary text-primary-foreground rounded-lg hover:bg-primary/90 transition-colors">
            Back to Home
</a>
        </div>
      </div>

<div class="min-h-screen bg-background">
      <div class="fixed top-4 left-4 z-40">
        <a
          href="/"
          class="inline-flex items-center gap-2 px-4 py-2 bg-card border border-border rounded-lg hover:bg-muted transition-colors text-foreground"
        >
          <i class="fa-solid fa-arrow-left" style="font-size: 20px;"></i>
          Back
</a>
      </div>

     
        <div class="relative h-64 sm:h-96 md:h-[500px] overflow-hidden">
          <img
          id="image"
            class="w-full h-full object-cover"
          />
          <div class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-background"></div>
        </div>
      

      <div class="relative -mt-32 sm:-mt-48 md:-mt-64 z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
          <div class="flex flex-col md:flex-row gap-8">
      <div class="flex-shrink-0">
        <div class="w-48 h-72 rounded-lg overflow-hidden shadow-2xl border border-border">
          <img
          id="poster"
            
            class="w-full h-full object-cover"
          />
        </div>
      </div>

      <div class="flex-1 text-foreground">
        <div class="mb-4">
          <h1 id="name" class="text-white text-4xl md:text-5xl font-bold mb-2"></h1>
          
            <p class="text-white text-lg text-muted-foreground italic">
              &quot;<span id="tagline"></span>&quot;
            </p>
          
        </div>

        <div class="flex flex-wrap gap-4 mb-6">
          <div class="flex items-center gap-2">
<i class="fa-solid fa-star text-yellow-500"></i>            <span id="vote" class="font-semibold"></span>
          </div>

          <div id="year" class="px-3 py-1 bg-primary/20 text-primary rounded-full text-sm font-medium">
            
          </div>

            <div id="numberOfSeasons" class="text-white px-3 py-1 bg-accent/20 text-accent rounded-full text-sm font-medium">
            </div>

            <div id="numberOfepisodes" class="text-white px-3 py-1 bg-secondary/20 text-secondary rounded-full text-sm font-medium">
            </div>
        </div>

          <div class="mb-6">
            <h3 class="text-sm font-semibold text-muted-foreground mb-2">
              Genres
            </h3>
            <div id="genres" class="flex flex-wrap gap-2">
              
            </div>
          </div>

        <div>
          <h3 class="text-sm font-semibold text-muted-foreground mb-2">
            Synopsis
          </h3>
          <p id="synopsis" class="text-foreground leading-relaxed max-w-2xl">
            
          </p>
        </div>
      </div>
    </div>

          <div class="mt-8 bg-card border border-border rounded-lg p-6">
            <h3 class="text-xl font-bold text-foreground mb-4">Select Episode</h3>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
              <div>
                <label class="block text-sm font-medium text-muted-foreground mb-3">
                  Season
                </label>
                <select
                  id="seasons"
                  class="w-full px-4 py-2 bg-background border border-border rounded-lg text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                >
                  
                </select>
              </div>

                <div>
                  <label class="block text-sm font-medium text-muted-foreground mb-3">
                    Episode
                  </label>
                  <select id="episodes"
                    class="w-full px-4 py-2 bg-background border border-border rounded-lg text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                  >
                   
                  </select>
                </div>
              

              <div>
                <label class="block text-sm font-medium text-muted-foreground mb-3">Server</label>
                 <select
                    id="servers"
                    class="w-full px-4 py-2 bg-background border border-border rounded-lg text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all cursor-pointer"
                    >
                    </select>
              </div>
            </div>
          </div>

          <!-- {episodes.length > 0 && (
            <EpisodeSelector
              episode={episodes[selectedEpisode - 1]}
              showId={showId}
              selectedServer={selectedServer}
            />
          )} -->


           <div class="mt-8 bg-card border border-border rounded-lg overflow-hidden">
      <div class="p-6 border-b border-border">
        <h2 id="current" class="text-2xl font-bold text-foreground mb-2">
        </h2>
        <p id="currentt" class="text-muted-foreground text-sm mb-4">
        </p>
        <p id="currenttt" class="text-foreground leading-relaxed">
        </p>
      </div>

      <div class="bg-background p-6">
        <div class="aspect-video w-full bg-black rounded-lg overflow-hidden">
            <!-- <div class="flex items-center justify-center w-full h-full">
              <div class="text-center">
                <div class="inline-block h-8 w-8 animate-spin rounded-full border-4 border-muted border-t-primary"></div>
                <p class="mt-4 text-muted-foreground text-sm">Loading player...</p>
              </div>
            </div> -->
          <iframe id="iframe"
            class="w-full h-full border-0"
            allowFullScreen
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
          ></iframe>
        </div>
      </div>

        <div class="p-6 border-t border-border">
          <div class="w-full max-w-2xl mx-auto rounded-lg overflow-hidden">
            <img
            id="last"
              class="w-full h-auto"
            />
          </div>
        </div>
    </div>




        </div>
      </div>
    </div>
<script>


function getStreamingUrl(
  showId,
  seasonNumber,
  episodeNumber,
  serverId
){
  // This is a mock implementation. In production, you would fetch real streaming URLs
  // For now, we'll use embed URLs from a demo streaming service
  
  const baseUrls = {
    server1: 'https://vidsrc.me/embed/tv/',
    server2: 'https://embed.sflix.com/embed/tv/',
    server3: 'https://vidsrc.to/embed/tv/',
    server4: 'https://multiembed.mov/?video_id=',
  };

  const baseUrl = baseUrls[serverId] || baseUrls.server1;

  // Format: showId-seasonNumber-episodeNumber
  if (serverId === 'server4') {
    return `${baseUrl}${showId}&tmdb=1&s=${seasonNumber}&e=${episodeNumber}`;
  }

  return `${baseUrl}${showId}/${seasonNumber}/${episodeNumber}`;
}


    const STREAMING_SERVERS = [
  {
    id: 'server1',
    name: 'Server 1',
    icon: '▶',
    color: 'from-blue-500 to-blue-700',
  },
  {
    id: 'server2',
    name: 'Server 2',
    icon: '▶',
    color: 'from-orange-500 to-orange-700',
  },
  {
    id: 'server3',
    name: 'Server 3',
    icon: '▶',
    color: 'from-orange-500 to-orange-700',
  },
  {
    id: 'server4',
    name: 'Server 4',
    icon: '▶',
    color: 'from-orange-500 to-orange-700',
  },
];

const servers = document.getElementById('servers')
STREAMING_SERVERS.forEach((server)=>{
    servers.innerHTML+=`<option value=${server.id}>
                        ${server.name}
                        </option>`
})



    const notfound = document.getElementById('notfound')
    const loading = document.getElementById('loading')
    const image = document.getElementById('image')
    const poster = document.getElementById('poster')
    const name = document.getElementById('name')
    const tagline = document.getElementById('tagline')
    const vote = document.getElementById('vote')
    const year = document.getElementById('year')
    let numberOfSeasons = document.getElementById('numberOfSeasons')
    let numberOfepisodes = document.getElementById('numberOfepisodes')
    let genres = document.getElementById('genres')
    let syno = document.getElementById('synopsis')
    let seasons = document.getElementById('seasons')
    let episodes = document.getElementById('episodes')
    let current = document.getElementById('current')
    let currentt = document.getElementById('currentt')
    let iframe = document.getElementById('iframe')
    let last = document.getElementById('last')
 	let serverId = "server1"

    const TMDB_BASE_URL = 'https://api.themoviedb.org/3';
const IMAGE_BASE_URL = 'https://image.tmdb.org/t/p/w1280';
const options = {
  method: 'GET',
  headers: {
    accept: 'application/json',
    Authorization: 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIyNmYzOTcwNGJhOTEwMjlkM2NhZDY3MzQwY2E2ODYwMCIsInN1YiI6IjY2MzZhNzk0OTU5MGUzMDEyM2JjNDlhNSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.ImAuflKe7r_PCIM-jUc8wa9hCTYlwFWQqhQaIXgKVhI'
  },
  next: { revalidate: 3600 }
};


function getImageUrl(path) {
  if (!path) return '/placeholder.png';
  return `${IMAGE_BASE_URL}${path}`;
}

async function fetchFromTMDB(endpoint, params) {
  const url = new URL(`${TMDB_BASE_URL}${endpoint}`);

  if (params) {
    Object.entries(params).forEach(([key, value]) => {
      url.searchParams.append(key, value);
    });
  }
  const response = await fetch(url.toString(), options);
  if (!response.ok) {
    throw new Error(`TMDB API error: ${response.statusText}`);
  }
  return response.json();
}
async function getShowDetails(id) {
  try {
    const data = await fetchFromTMDB(`/tv/${id}`, { append_to_response: 'genres' });
    return {
      id: data.id,
      name: data.name,
      poster_path: data.poster_path,
      backdrop_path: data.backdrop_path,
      overview: data.overview,
      first_air_date: data.first_air_date,
      vote_average: data.vote_average,
      tagline: data.tagline,
      genres: data.genres,
      number_of_seasons: data.number_of_seasons,
      number_of_episodes: data.number_of_episodes,
    };
  } catch (error) {
    console.error('Error fetching show details:', error);
    return null;
  }
}

async function getSeasons(id){
  try {
    const data = await fetchFromTMDB(`/tv/${id}`);
    return data.seasons.map((season) => ({
      id: season.id,
      season_number: season.season_number,
      name: season.name,
      episode_count: season.episode_count,
      air_date: season.air_date,
      poster_path: season.poster_path,
    }));
  } catch (error) {
    console.error('Error fetching seasons:', error);
    return [];
  }
}

async function getEpisodes(id, seasonNumber){
  try {
    const data = await fetchFromTMDB(`/tv/${id}/season/${seasonNumber}`);
    return data.episodes.map((episode) => ({
      id: episode.id,
      episode_number: episode.episode_number,
      name: episode.name,
      overview: episode.overview,
      air_date: episode.air_date,
      still_path: episode.still_path,
      season_number: episode.season_number,
    }));
  } catch (error) {
    console.error('Error fetching episodes:', error);
    return [];
  }
}


async function getShow(showId){
    const details = await getShowDetails(showId);
    image.src = getImageUrl(details.backdrop_path)
    image.alt = details.name
syno.textContent = details.overview
    poster.src = getImageUrl(details.poster_path)
    poster.alt = details.name
    name.textContent = details.name
    tagline.textContent = details.tagline
    year.textContent = details.first_air_date ? new Date(details.first_air_date).getFullYear() : 'N/A';
    vote.textContent = `${details.vote_average.toFixed(1)}/10`
    details.genres.forEach((genre)=>{
        genres.innerHTML+=`<div
                  class="px-3 py-1 border border-border rounded-lg text-sm text-foreground hover:border-primary transition-colors"
                >
                  ${genre.name}
                </div>`
    })
      if (details) {
        const seasonList = await getSeasons(showId);
        numberOfSeasons.textContent = `${details.number_of_seasons} Season${details.number_of_seasons !== 1 ? 's' : ''}`
        seasonList.forEach((season)=>{
            seasons.innerHTML += `<option value=${season.season_number}>
                      Season ${season.season_number}
                    </option>`
        })

        // Get episodes for first season
        if (seasonList.length > 0) {
          const firstSeasonEpisodes = await getEpisodes(showId, seasonList[0].season_number);
        numberOfepisodes.textContent = `${details.number_of_episodes} Episode${details.number_of_episodes !== 1 ? 's' : ''}`
          firstSeasonEpisodes.forEach((episode)=>{
                episodes.innerHTML += `<option data-one="Season ${episode.season_number}, Episode ${episode.episode_number}: ${episode.name}" data-two="Air Date: ${episode.air_date || 'TBA'}" data-three="${episode.overview || 'No description available.'}" value=${episode.episode_number} data-name=${episode.name} data-src=${getImageUrl(episode.still_path)} value=${episode.episode_number}>
                        Ep. ${episode.episode_number}: ${episode.name}
                      </option>`
          })
          

        
          if(firstSeasonEpisodes.length>0){
                current.innerHTML = `Season ${firstSeasonEpisodes[0].season_number}, Episode ${firstSeasonEpisodes[0].episode_number}: ${firstSeasonEpisodes[0].name}`

                currentt.innerHTML = `Air Date: ${firstSeasonEpisodes[0].air_date || 'TBA'}`
                currenttt.innerHTML = `${firstSeasonEpisodes[0].overview || 'No description available.'}`

                iframe.title = `${firstSeasonEpisodes[0].name} - Season ${firstSeasonEpisodes[0].season_number} Episode ${firstSeasonEpisodes[0].episode_number}`


                  const streamingUrl = getStreamingUrl(<?php echo $showId;?>, firstSeasonEpisodes[0].season_number, firstSeasonEpisodes[0].episode_number, serverId);

                    iframe.src = streamingUrl
                  last.src = `${getImageUrl(firstSeasonEpisodes[0].still_path)}`
                  last.alt = `${firstSeasonEpisodes[0].name}`

          }
          loading.style.display="none"
        }
      }else{
            notfound.style.display="flex"
            loading.style.display="none"
        }
}


getShow(<?php echo $showId;?>)



seasons.addEventListener("change", async function () {
    const seasonNumber = parseInt(this.value);

    const episodess = await getEpisodes(<?php echo $showId;?>, seasonNumber);

episodes.innerHTML = ""
    episodess.forEach((episode)=>{ episodes.innerHTML += `<option data-one="Season ${episode.season_number}, Episode ${episode.episode_number}: ${episode.name}" data-two="Air Date: ${episode.air_date || 'TBA'}" data-three="${episode.overview || 'No description available.'}" value=${episode.episode_number} data-name=${episode.name} data-src=${getImageUrl(episode.still_path)}> Ep. ${episode.episode_number}: ${episode.name} </option>` })

const streamingUrl = getStreamingUrl(<?php echo $showId;?>, episodess[0].season_number, episodess[0].episode_number, serverId);

                    iframe.src = streamingUrl
                  last.src = `${getImageUrl(episodess[0].still_path)}`
                  last.alt = `${episodess[0].name}`
    // Exemple :
    // displayEpisodes(episodes);


    current.innerHTML = `Season ${episodess[0].season_number}, Episode ${episodess[0].episode_number}: ${episodess[0].name}`

                currentt.innerHTML = `Air Date: ${episodess[0].air_date || 'TBA'}`
                currenttt.innerHTML = `${episodess[0].overview || 'No description available.'}`



});


episodes.addEventListener("change", async function () {
    const selectedOption = this.selectedOptions[0];

    const episodeNumber = parseInt(this.value);
    const seasonNumber = parseInt(document.getElementById("seasons").value);

    const episodeName = selectedOption.dataset.name;
    const imageSrc = selectedOption.dataset.src;


    current.innerHTML = selectedOption.dataset.one

                currentt.innerHTML = selectedOption.dataset.twp
                currenttt.innerHTML = selectedOption.dataset.three



    const streamingUrl = getStreamingUrl(
        <?php echo $showId; ?>,
        seasonNumber,
        episodeNumber,
        serverId
    );

    iframe.src = streamingUrl;

    last.src = imageSrc;
    last.alt = episodeName;
});



servers.addEventListener("change", async function () {
    const selectedOption = this.selectedOptions[0];

    const seasonNumber = parseInt(document.getElementById("seasons").value);
    const episodeNumber = parseInt(document.getElementById("episodes").value);

    // const episodeName = selectedOption.dataset.name;
    // const imageSrc = selectedOption.dataset.src;


    // current.innerHTML = selectedOption.dataset.one

    //             currentt.innerHTML = selectedOption.dataset.twp
    //             currenttt.innerHTML = selectedOption.dataset.three


	serverId = selectedOption.value
    const streamingUrl = getStreamingUrl(
        <?php echo $showId; ?>,
        seasonNumber,
        episodeNumber,
        selectedOption.value
    );

    iframe.src = streamingUrl;

    // last.src = imageSrc;
    // last.alt = episodeName;
});


</script>
</body>
</html>