<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <!-- Basic -->
    <meta name="monetag" content="8ce59ab5474ff4ef6ea88fee83512b7c">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO -->
    <title>StreamVibe - Watch TV Series Online</title>

    <meta name="description"
          content="Watch TV series online with StreamVibe. Discover popular and trending shows, explore seasons and episodes, and enjoy a smooth streaming experience.">

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

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="StreamVibe - Watch TV Series Online">
    <meta property="og:description"
          content="Discover and watch TV series online with StreamVibe. Explore popular shows, seasons and episodes.">
    <meta property="og:url" content="https://streamvibe.lovestoblog.com/">
    <meta property="og:site_name" content="StreamVibe">
    <meta property="og:image" content="https://streamvibe.lovestoblog.com/images/og-image.jpg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="StreamVibe - Watch TV Series Online">

    <!-- Twitter / X -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="StreamVibe - Watch TV Series Online">
    <meta name="twitter:description"
          content="Discover and watch TV series online with StreamVibe.">
    <meta name="twitter:image" content="https://streamvibe.lovestoblog.com/images/og-image.jpg">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/favicon.png">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <!-- Styles -->
    <link rel="stylesheet" href="../public/styles.css">

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
        #loader,#noFound,#resultsUi,#notfound{
display:none;
}
.section{
display:none;
}
    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-background">
       <header class="absolute top-0 left-0 right-0 z-50 bg-gradient-to-b from-background via-background to-transparent border-b border-border/50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex items-center justify-between gap-8">
          <a href="/" class="flex-shrink-0">
            <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-500 to-purple-500 bg-clip-text text-transparent">
              StreamVibe
            </h1>
        </a>

          <div class="flex-1 max-w-md">
            <div class="relative">
              <input
                id="inputQuery"
                type="text"
                placeholder="Search TV series..."
                class="w-full px-4 py-2 bg-card border border-border rounded-lg text-foreground placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
              />
              
                <div id="loader" class="absolute right-3 top-1/2 -translate-y-1/2">
    <div class="h-4 w-4 animate-spin rounded-full border-2 border-gray-300 border-t-blue-600"></div>
</div>
              
            </div>
          </div>
        </div>
      </div>
    </header>
<section class="py-12 px-4 sm:px-6 lg:px-8">
      <div class="max-w-7xl mx-auto">
        <h2 id="resultsUi" class="text-3xl font-bold my-8 text-foreground">
          Search Results (<span id="resultsNumber"></span>)
        </h2>

        
          <div id="noFound" class="text-center py-12">
            <p class="text-muted-foreground text-lg">No shows found</p>
          </div>
        
          <div id="searchResultsUi" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
            
              
          </div>
      </div>
    </section>
      <!-- <main class="pt-20 pb-12">
        {isSearching ? (
          <SearchResults results={searchResults} />
        ) : (
          <>
            {loading ? (
              
            ) : (
              <>
                <ShowCarousel title="Trending Now" shows={trendingShows} />
                <ShowCarousel title="Popular" shows={popularShows} />
              </>
            )}
          </>
        )}
      </main> -->


      <section class="section py-12 px-4 sm:px-6 lg:px-8">
      <div class="max-w-7xl mx-auto">
        <h2 class="text-3xl font-bold mb-6 text-foreground">Trending Now</h2>

        <div class="relative group">
          <button
            onclick="scroll1('left')"
            class="absolute left-0 top-1/2 -translate-y-1/2 -ml-4 z-20 opacity-0 group-hover:opacity-100 transition-opacity"
            aria-label="Scroll left"
          >
            <div class="bg-primary/80 hover:bg-primary rounded-full p-2 transition-colors">
              <i style="background-color: #ccc;color:black;border-radius:50%;" class="fa-solid fa-chevron-left text-primary-foreground text-2xl"></i>
            </div>
          </button>

          <div
            id="trending" class="flex gap-4 overflow-x-auto scrollbar-hide"
          >
            
              
          </div>

          <button
          onclick="scroll1('right')"
            class="absolute right-0 top-1/2 -translate-y-1/2 -mr-4 z-20 opacity-0 group-hover:opacity-100 transition-opacity"
            aria-label="Scroll right"
          >
            <div class="bg-primary/80 hover:bg-primary rounded-full p-2 transition-colors">
              <i style="background-color: #ccc;color:black;border-radius:50%;" class="fa-solid fa-chevron-right text-primary-foreground text-2xl"></i>
            </div>
          </button>
        </div>
      </div>

    
    </section>


    <section class="section py-12 px-4 sm:px-6 lg:px-8">
      <div class="max-w-7xl mx-auto">
        <h2 class="text-3xl font-bold mb-6 text-foreground">Popular</h2>

        <div class="relative group">
          <button
          onclick="scroll2('left')"
            class="absolute left-0 top-1/2 -translate-y-1/2 -ml-4 z-20 opacity-0 group-hover:opacity-100 transition-opacity"
            aria-label="Scroll left"
          >
            <div class="bg-primary/80 hover:bg-primary rounded-full p-2 transition-colors">
              <i style="background-color: #ccc;color:black;border-radius:50%;" class="fa-solid fa-chevron-left text-primary-foreground text-2xl"></i>
            </div>
          </button>

          <div
            id="popular" class="flex gap-4 overflow-x-auto scrollbar-hide"
          >
            
              
          </div>

          <button
          onclick="scroll2('right')"
            class="absolute right-0 top-1/2 -translate-y-1/2 -mr-4 z-20 opacity-0 group-hover:opacity-100 transition-opacity"
            aria-label="Scroll right"
          >
            <div class="bg-primary/80 hover:bg-primary rounded-full p-2 transition-colors">
             <i style="background-color: #ccc;color:black;border-radius:50%;" class="fa-solid fa-chevron-right text-primary-foreground text-2xl"></i>
            </div>
          </button>
        </div>
      </div>

    
    </section>



      <div id="search" class="flex items-center justify-center py-20">
                <div class="text-center">
                  <div class="inline-block h-8 w-8 animate-spin rounded-full border-4 border-muted border-t-primary"></div>
                  <p class="mt-4 text-muted-foreground">Loading shows...</p>
                </div>
              </div>

              
    </div>
    <script>
const IMAGE_BASE_URL = 'https://image.tmdb.org/t/p/w500';


        
function getImageUrl(path) {
  if (!path) return '/placeholder.png';
  return `${IMAGE_BASE_URL}${path}`;
}

async function getTrendingShows() {
  try {
    const data = await fetchFromTMDB('/trending/tv/week');
    return data.results.slice(0, 10).map((show) => ({
      id: show.id,
      name: show.name,
      poster_path: show.poster_path,
      backdrop_path: show.backdrop_path,
      overview: show.overview,
      first_air_date: show.first_air_date,
      vote_average: show.vote_average,
    }));
  } catch (error) {
    console.error('Error fetching trending shows:', error);
    return [];
  }
}

async function getPopularShows() {
  try {
    const data = await fetchFromTMDB('/tv/popular');
    return data.results.slice(0, 10).map((show) => ({
      id: show.id,
      name: show.name,
      poster_path: show.poster_path,
      backdrop_path: show.backdrop_path,
      overview: show.overview,
      first_air_date: show.first_air_date,
      vote_average: show.vote_average,
    }));
  } catch (error) {
    console.error('Error fetching popular shows:', error);
    return [];
  }
}



        let inputQuery = document.getElementById('inputQuery')
        let search = document.getElementById('search')
        let loader = document.getElementById('loader')
        let noFound = document.getElementById('noFound')
        let resultsNumber = document.getElementById('resultsNumber')
        let searchResultsUi = document.getElementById('searchResultsUi')
        let resultsUi = document.getElementById('resultsUi')
        let trending = document.getElementById('trending')
        let popular = document.getElementById('popular')


        const scroll1 = (direction) => {
    if (trending) {
      const scrollAmount = 400;
      trending.scrollBy({
        left: direction === 'left' ? -scrollAmount : scrollAmount,
        behavior: 'smooth',
      });
    }
  };


  const scroll2 = (direction) => {
    if (popular) {
      const scrollAmount = 400;
      popular.scrollBy({
        left: direction === 'left' ? -scrollAmount : scrollAmount,
        behavior: 'smooth',
      });
    }
  };


        let sections = document.querySelectorAll('.section')
        let TMDB_BASE_URL = "https://api.themoviedb.org/3"
        let searchResults = []

        const options = {
  method: 'GET',
  headers: {
    accept: 'application/json',
    Authorization: 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIyNmYzOTcwNGJhOTEwMjlkM2NhZDY3MzQwY2E2ODYwMCIsInN1YiI6IjY2MzZhNzk0OTU5MGUzMDEyM2JjNDlhNSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.ImAuflKe7r_PCIM-jUc8wa9hCTYlwFWQqhQaIXgKVhI'
  },
  next: { revalidate: 3600 }
};
async function fetchFromTMDB(endpoint, params, signal) {
    const url = new URL(`${TMDB_BASE_URL}${endpoint}`);

    if (params) {
        Object.entries(params).forEach(([key, value]) => {
            url.searchParams.append(key, value);
        });
    }

    const response = await fetch(url.toString(), {
        ...options,
        signal
    });

    if (!response.ok) {
        throw new Error(`TMDB API error: ${response.statusText}`);
    }

    return response.json();
}
let trendingShows = []
let popularShows = []
async function getBestShow(){

    trendingShows = await getTrendingShows()
    let outTrending = ""
    trendingShows.forEach((show)=>{
        outTrending += `<a
                href="watch.php?id=${show.id}"
                class="flex-shrink-0 group/card transition-transform duration-300 hover:scale-105"
              >
                <div class="w-48 h-72 bg-card rounded-lg overflow-hidden border border-border hover:border-primary transition-colors shadow-lg hover:shadow-primary/50">
                  <div class="relative w-full h-full bg-muted">
                    <img
                      src=${getImageUrl(show.poster_path)}
                      alt=${show.name}
                      class="w-full h-full object-cover"
                      loading="lazy"
                    />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover/card:opacity-100 transition-opacity flex flex-col justify-end p-4">
                      <h3 class="text-white font-bold text-sm mb-2 line-clamp-2">
                        ${show.name}
                      </h3>
                      <p class="text-gray-300 text-xs line-clamp-2">
                        ${show.overview}
                      </p>
                    </div>
                  </div>
                </div>
            </a>`
    })
    trending.innerHTML = outTrending
    popularShows = await getPopularShows()


    let outPopular = ""
    popularShows.forEach((show)=>{
        outPopular += `<a
                href="/watch.php?id=${show.id}"
                class="flex-shrink-0 group/card transition-transform duration-300 hover:scale-105"
              >
                <div class="w-48 h-72 bg-card rounded-lg overflow-hidden border border-border hover:border-primary transition-colors shadow-lg hover:shadow-primary/50">
                  <div class="relative w-full h-full bg-muted">
                    <img
                      src=${getImageUrl(show.poster_path)}
                      alt=${show.name}
                      class="w-full h-full object-cover"
                      loading="lazy"
                    />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover/card:opacity-100 transition-opacity flex flex-col justify-end p-4">
                      <h3 class="text-white font-bold text-sm mb-2 line-clamp-2">
                        ${show.name}
                      </h3>
                      <p class="text-gray-300 text-xs line-clamp-2">
                        ${show.overview}
                      </p>
                    </div>
                  </div>
                </div>
            </a>`
    })

    popular.innerHTML = outPopular
    search.style.display = "none"
sections.forEach((section)=>{
    section.style.display = "block"
})

}
getBestShow()

        let searchTimeout;
let searchController = null;
let searchRequestId = 0;

inputQuery.addEventListener("input", function (e) {
    const query = e.target.value.trim();

    clearTimeout(searchTimeout);

    // Cancel previous request
    if (searchController) {
        searchController.abort();
        searchController = null;
    }

    if (!query) {
        searchResults = [];
        resultsUi.style.display = "none";
        searchResultsUi.innerHTML = "";
        loader.style.display = "none";

        sections.forEach(section => {
            section.style.display = "";
        });

        popular.style.display = "flex";
        trending.style.display = "flex";

        getBestShow();
        return;
    }

    // Wait until user stops typing
    searchTimeout = setTimeout(() => {
        performSearch(query);
    }, 400);
});


async function performSearch(query) {
    const requestId = ++searchRequestId;

    loader.style.display = "block";
    resultsUi.style.display = "block";

    try {
        searchController = new AbortController();

        const results = await searchShows(
            query,
            searchController.signal
        );

        // Ignore old response
        if (requestId !== searchRequestId) return;

        searchResults = results || [];

        resultsNumber.textContent = searchResults.length;

        if (searchResults.length > 0) {
            sections.forEach(section => {
                section.style.display = "none";
            });
        }

        renderSearchResults(searchResults);

        popular.style.display = "none";
        trending.style.display = "none";

    } catch (error) {
        if (error.name !== "AbortError") {
            console.error("Search error:", error);
            searchResults = [];
            searchResultsUi.innerHTML = "";
        }
    } finally {
        if (requestId === searchRequestId) {
            loader.style.display = "none";
        }
    }
}


function renderSearchResults(results) {
    if (!results.length) {
        searchResultsUi.innerHTML = `
            <div class="col-span-full py-10 text-center text-gray-400">
                No results found
            </div>
        `;
        return;
    }

    const html = results.map(result => {
        const name = escapeHtml(result.name || "Unknown");
        const overview = escapeHtml(result.overview || "");

        const image = result.poster_path
            ? getImageUrl(result.poster_path)
            : "../public/no_image.jpg";

        return `
            <a
                href="watch.php?id=${result.id}"
                class="group transition-transform duration-300 hover:scale-105"
            >
                <div
                    class="w-full aspect-[2/3]
                    bg-card rounded-lg overflow-hidden
                    border border-border
                    hover:border-primary
                    transition-colors
                    shadow-lg hover:shadow-primary/50"
                >
                    <div class="relative w-full h-full bg-muted">

                        <img
                            src="${image}"
                            alt="${name}"
                            class="w-full h-full object-cover"
                            loading="lazy"
                        />

                        <div
                            class="absolute inset-0
                            bg-gradient-to-t
                            from-black/80
                            via-transparent
                            to-transparent
                            opacity-0
                            group-hover:opacity-100
                            transition-opacity
                            flex flex-col
                            justify-end
                            p-3"
                        >
                            <h3
                                class="text-white font-bold text-sm mb-1 line-clamp-2"
                            >
                                ${name}
                            </h3>

                            <p
                                class="text-gray-300 text-xs line-clamp-2"
                            >
                                ${overview}
                            </p>
                        </div>

                    </div>
                </div>
            </a>
        `;
    }).join("");

    searchResultsUi.innerHTML = html;
}


function escapeHtml(value) {
    const div = document.createElement("div");
    div.textContent = value;
    return div.innerHTML;
}
        


       async function searchShows(query, signal) {
    try {
        const data = await fetchFromTMDB(
            '/search/tv',
            { query },
            signal
        );

        return (data.results || []).map(show => ({
            id: show.id,
            name: show.name,
            poster_path: show.poster_path,
            backdrop_path: show.backdrop_path,
            overview: show.overview,
            first_air_date: show.first_air_date,
            vote_average: show.vote_average
        }));

    } catch (error) {
        // Don't log cancelled requests as errors
        if (error.name !== 'AbortError') {
            console.error('Error searching shows:', error);
        }

        return [];
    }
}
    </script>
</body>
</html>