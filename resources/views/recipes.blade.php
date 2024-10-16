<x-layout>
  <section class="bg-[#f2eed7]">
    <section class="py-8 px-4 mx-auto max-w-screen-xl lg:py-8 lg:px-8">
      <h2 class="mb-8 text-4xl tracking-tight font-extrabold text-center text-gray-900 dark:text-white">What do you want to cook today?</h2>

      <div class="mb-2 mx-auto max-w-screen-xl px-4 2xl:px-0">
        <div class="mx-auto max-w-screen-md sm:text-center">
          <form action="/recipes" method="get">
              @if(request('category'))
                  <input type="hidden" name="category" value="{{ request('category') }}">
              @endif
              @if(request('course'))
                  <input type="hidden" name="course" value="{{ request('course') }}">
              @endif
              <div class="items-center mx-auto mb-3 space-y-4 max-w-screen-sm sm:flex sm:space-y-0">
                  <div class="relative w-full">
                      <label for="email" class="hidden mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email address</label>
                      <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                          <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                              <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                          </svg>
                      </div>
                      <input class="block p-3 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:rounded-none sm:rounded-l-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search Article" type="search" id="search" name="search" autocomplete="off">
                  </div>
                  <div>
                      <button type="submit" class="py-3 px-5 w-full text-sm font-medium text-center text-white rounded-lg border cursor-pointer bg-primary-700 border-primary-600 sm:rounded-none sm:rounded-r-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Search</button>
                  </div>
              </div>
          </form>
        </div>
      </div>
    </section>

    <section class="py-8 px-4 mx-auto max-w-screen-xl lg:py-4 lg:px-24">
      <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
          @foreach ($courses as $course)
          <a href="/recipes?course={{ $course->name }}" class="flex items-center rounded-lg border border-gray-200 bg-white px-6 py-2 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
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
            <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $course->name }}</span>
          </a>
          @endforeach
        </div>
      </div>
    </section>
    
    
    <section class="py-4 px-4 mx-auto  lg:py-6 lg:px-6">
      <div class="mx-auto px-16 ">
        {{ $foods->links() }}
        <div class="mb-4 grid gap-4 my-4 sm:grid-cols-2 md:mb-8 lg:grid-cols-3 xl:grid-cols-4">
        @forelse ($foods as $food)
          <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="h-56 w-full">
              <a href="#">
                <img class="mx-auto h-full dark:hidden" src="{{ $food->image }}" alt="" />
              </a>
            </div>
            <div class="pt-6">
              <div class="mb-2 flex items-center">
                <!-- category -->
                <span class="me-2 rounded bg-gray-200 px-2.5 py-0.5 text-xs font-medium text-gray-800 dark:bg-primary-900 dark:text-primary-300">
                  <a href="/recipes?course={{ $food->course->name }}">{{ $food->course->name }}</a>
                </span> 
                <span class="me-2 rounded bg-{{ $food->category->color }}-100 px-2.5 py-0.5 text-xs font-medium text-{{ $food->category->color }}-800 dark:bg-primary-900 dark:text-primary-300">
                  <a href="/recipes?category={{ $food->category->slug }}">{{ $food->category->name }}</a>
                </span> 

                <button type="button" data-tooltip-target="tooltip-add-to-favorites" class="rounded-lg p-2 ml-auto text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                  <span class="sr-only"> Add to Favorites </span>
                  <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                  </svg>
                </button>
                <div id="tooltip-add-to-favorites" role="tooltip" class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700" data-popper-placement="top">
                  Add to favorites
                  <div class="tooltip-arrow" data-popper-arrow=""></div>
                </div>
              </div>
            </div>
    
              <a href="/recipes/{{ $food->slug }}" class="text-lg font-semibold leading-tight text-gray-900 hover:underline dark:text-white">{{ $food->name }}</a>
    
              <div class="mt-2 flex items-center gap-2">
                <div class="flex items-center">
                  <svg class="h-4 w-4 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                  </svg>
                </div>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ $food->likes }}</p>
              </div>
    
              <div class="mt-4 flex items-center justify-between gap-4">
                <span class="text-xl font-extrabold leading-tight text-gray-900 dark:text-white">
                  <p class="text-xs text-gray-700 dark:text-white">est</p>
                  {{ $food->est_price }}
                </span>
    
                <button type="button" class="inline-flex items-center rounded-lg bg-primary-700 px-4 py-1.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4  focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                  <svg class="-ms-2 me-2 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                    <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                  </svg>
                  View Recipe
                </button>
              </div>
          </div>
        @empty
          <div class="col-start-1 col-end-12 flex flex-col items-center justify-center">
              <p class="font-semibold text-xl my-4">What you're looking for isn't here!!</p>
              <a href="/recipes" class="block text-blue-600 hover:underline">&laquo; back to posts</a>
          </div>
        @endforelse
        </div>
        {{ $foods->links() }}
      </div>
    </section>
  </section>
</x-layout>