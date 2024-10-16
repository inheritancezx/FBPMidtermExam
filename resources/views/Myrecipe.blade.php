<x-layout>
    <div class="flex flex-col w-full gap-y-6 px-12 my-12">
        <main class="pt-4 lg:px-6 dark:bg-gray-900 antialiased">
            <div class=" justify-between px-4 mx-auto max-w-screen-xl">
                <article class="max-w-4xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
                    <header class="mb-4 lg:mb-6 not-format">
                        <a href="/profile" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-primary-600 dark:text-gray-400 dark:hover:text-white">
                            &laquo;
                            <svg xmlns="http://www.w3.org/2000/svg" class="me-2 h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <!-- Head -->
                                <circle cx="12" cy="7" r="4" />
                                
                                <!-- Body -->
                                <path d="M12 11 C16 11 19 14 19 18 L5 18 C5 14 8 11 12 11 Z" />
                              </svg>
                              
                           Back to profile
                        </a>
                    </header>

                    <span class="my-2 bg-gray-200 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800">
                        <a href="/recipes?course={{ $recipe->course->name }}">{{ $recipe->course->name }}</a>
                    </span>
                    <span class="my-2 bg-{{ $recipe->category->color }}-100 text-{{ $recipe->category->color }}-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800">
                        <a href="/recipes?category={{ $recipe->category->slug }}">{{ $recipe->category->name }}</a>
                    </span>
                
                    <h1 class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white">{{ $recipe->name }}</h1>
                    <p>{{ $recipe->content }}</p>
                </article>
            </div>
        </main> 
    </div>           
</x-layout>

