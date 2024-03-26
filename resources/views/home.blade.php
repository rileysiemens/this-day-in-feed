@php
    $variable = 'Testing';
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>This Day In...</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50 font-[figtree]">
        <div class="flex justify-center pt-16">
            <div class="flex flex-col">
                <input type="text" name="feed" class="text-gray-900 px-6 py-4 w-screen max-w-xl text-xl rounded-lg" placeholder="http://feeds.feedburner.com/examplepodcast" onkeyup="processFeed()" />
            </div>
        </div>

        <script>
            function debounce(func, timeout = 300) {
                let timer;
                return (...args) => {
                    clearTimeout(timer)
                    timer = setTimeout(() => func.apply(this, args), timeout)
                }
            }

            async function getTodaysEpisode() {
                let input = document.querySelector('input[name=feed]')

                if (input.value) {
                    fetch("", {
                        method: "POST",
                        headers: {
                            Accept: "application/json",
                            "Content-Type": "application/json",
                            "X-CSRF-Token": @json(csrf_token()),
                        },
                        body: JSON.stringify({
                            url: input.value
                        }),
                    })
                    .then(response => response.json())
                    .then(json => {
                        // display the episode or something
                    })
                    .catch(error => {
                        // show an error or something
                    })
                } else {
                    // clear screen or something
                }
            }

            const processFeed = debounce(() => getTodaysEpisode())
        </script>
    </body>
</html>
