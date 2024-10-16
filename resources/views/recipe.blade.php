<x-layout>
    <div class="flex flex-col w-full gap-y-6 px-12 my-12">
        <main class="pt-4 lg:px-6 dark:bg-gray-900 antialiased">
            <div class=" justify-between px-4 mx-auto max-w-screen-xl">
                <article class="max-w-4xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
                    <header class="mb-4 lg:mb-6 not-format">
                        <a href="/recipes" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-primary-600 dark:text-gray-400 dark:hover:text-white">
                            &laquo;
                            <svg xmlns="http://www.w3.org/2000/svg" class="me-2 h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <!-- Spoon -->
                                <path d="M7 2 C9 2 10 4 10 6 C10 8 9 10 7 10 C5 10 4 8 4 6 C4 4 5 2 7 2 Z" />
                                <path d="M7 10 L7 22" />
                                
                                <!-- Fork -->
                                <path d="M17 2 L17 12" />
                                <path d="M15 2 L19 2" />
                                <path d="M15 4 L19 4" />
                                <path d="M15 6 L19 6" />
                                <path d="M15 8 L19 8" />
                                <path d="M17 12 L17 22" />
                            </svg>
                           Back to recipes
                        </a>
                    </header>
                    
                    <div class="flex justify-center items-center">
                        <img class="max-w-sm rounded-lg mb-4 mt-4" src="{{ $food->image }}" alt=""/>
                    </div>
                    <span class="inline-flex items-right justify-end gap-2 w-full">
                        <div class="flex items-center">
                          <svg class="h-4 w-4 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                          </svg>
                        </div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ $food->likes }}</p>
                    </span>
                    <div class="flex items-center justify-between w-full">
                        <!-- Left Section (Course and Category) -->
                        <div class="inline-flex items-center gap-2">
                          <!-- Course -->
                          <span class="my-2 bg-gray-200 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800">
                            <a href="/recipes?course={{ $food->course->name }}">{{ $food->course->name }}</a>
                          </span>
                      
                          <!-- Category -->
                          <span class="my-2 bg-{{ $food->category->color }}-100 text-{{ $food->category->color }}-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800">
                            <a href="/recipes?category={{ $food->category->slug }}">{{ $food->category->name }}</a>
                          </span>
                        </div>
                      
                        <!-- Right Section (Est Price) -->
                        <span class="inline-flex items-center text-xl font-extrabold leading-tight text-gray-900 dark:text-white">
                          <p class="text-xs text-gray-700 dark:text-white me-1">est</p>
                          {{ $food->est_price }}
                        </span>
                    </div>
                      
                    <h1 class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white">{{ $food->name }}</h1>
                    <p>{{ $food->content }}</p>
                </article>
            </div>
        </main> 
    </div>           
</x-layout>

