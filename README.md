<div align=center>

# Framework Base Programming <br> Midterm Exam Recipe Web
Fayza Aqila Bachtiar - 5025221087 <br>
Tabina Callistadya - 5025221318

</div> 

### Overview
The midterm exam requires us to work as a group on a website programmed using laravel framework and a development environment, by implementing CRUD features.

### UI Documentation
**Register Page**

<img width="1470" alt="Screenshot 2024-10-17 at 23 33 22" src="https://github.com/user-attachments/assets/253920c4-4452-4faf-bb5f-9029fa586edc">

**Login Page**

<img width="1470" alt="Screenshot 2024-10-17 at 23 33 39" src="https://github.com/user-attachments/assets/790c3c04-e544-47c5-9224-e9f53fafd924">


**Home page / Landing Page**

<img width="1470" alt="Screenshot 2024-10-17 at 23 31 34" src="https://github.com/user-attachments/assets/fb144bb1-eed4-4d8f-ad99-d22bac8439b9">

<img width="1470" alt="Screenshot 2024-10-17 at 23 32 18" src="https://github.com/user-attachments/assets/d2e424de-8dad-45ee-93d0-e3c990a79394">

**About Page**



**FAQ Page**

<img width="1470" alt="Screenshot 2024-10-17 at 23 32 59" src="https://github.com/user-attachments/assets/cebc141f-7413-49dc-abaa-af9db3ede739">

**Recipes Page**

<img width="1470" alt="Screenshot 2024-10-17 at 23 34 20" src="https://github.com/user-attachments/assets/c9cc2b98-9a97-4670-8b4d-a9dcd1985f45">

<img width="1470" alt="Screenshot 2024-10-17 at 23 34 39" src="https://github.com/user-attachments/assets/0029c90b-3659-4945-95d0-7f5cf17cadd3">

<img width="1470" alt="Screenshot 2024-10-17 at 23 34 54" src="https://github.com/user-attachments/assets/8b844728-1b16-4c38-9320-ace6654038c8">

<img width="1470" alt="Screenshot 2024-10-17 at 23 35 26" src="https://github.com/user-attachments/assets/721c46b7-a591-40ff-821d-201580f5f334">

<img width="232" alt="Screenshot 2024-10-17 at 23 35 42" src="https://github.com/user-attachments/assets/85d1a0b6-d1b4-4929-ae78-1e3392a1d95a">

**Profile Page**

<img width="1470" alt="Screenshot 2024-10-17 at 23 36 16" src="https://github.com/user-attachments/assets/160fa7d0-7e80-4169-bf42-524edb40c748">

## Authentication

The first authentication used is to determine the routing for the navbar. If thee user is authorized, they will be routed to recipes page, but if it is not (guest), it will be routed to the login page first.

```php
                @Auth
                <li>
                    <a href="/recipes"  class="block py-2 pr-4 pl-3 font-extrabold text-[#fefae0] border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-[#3e4058] lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700"
                    >Recipes</a>
                </li>
                @else
                <li>
                    <a href="/login"  class="block py-2 pr-4 pl-3 font-extrabold text-[#fefae0] border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-[#3e4058] lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700"
                    >Recipes</a>
                </li>
                @endauth
```
The second authentication is to determine which button will be displayed in the user UI on the top right corner. If it is authenticated, it will display a button named "Add Recipe" that is used for the user to add their own recipe to the website. Theres also a profile that has a dropdown menu containing "Profile" that will navigate to the profile page and "Log Out" to terminate/destroy the user session. But if its not authenticated, then it will display 2 button. Which are "Log In" that will route to the login page and "Dont have an account yet?" that will route to the register page.

```php
<div class="flex lg:order-2 items-end justify-end absolute right-12">
            @Auth
            <button type="button" id="updateProductButton" data-modal-target="updateProductModal" data-modal-toggle="updateProductModal" class="hidden sm:inline-flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-xs px-3 py-1.5 mr-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                <svg aria-hidden="true" class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                </svg>
                Add Recipe
            </button>
            <button type="button" class="flex mx-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="dropdown">
            <span class="sr-only">Open user menu</span>
            <img class="w-8 h-8 rounded-full" src="/img/oreopudding.jpg" alt="user photo">
            </button>

            <!-- Dropdown menu -->
            <div class="hidden z-50 my-4 w-56 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown">
                <div class="py-3 px-4">
                    <span class="block text-sm font-semibold text-gray-900 dark:text-white">{{ Auth::user()->name }}</span>
                    <span class="block text-sm text-gray-500 truncate dark:text-gray-400">{{ Auth::user()->email }}</span>
                </div>
                <ul class="py-1 text-gray-500 dark:text-gray-400" aria-labelledby="dropdown">
                    <li>
                        <a href="/profile" class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">My profile</a>
                    </li>
                    <li>
                        <form action="/logout" method="POST" class=" hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">
                            @csrf
                            <button type="submit" class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">Sign Out</button>
                        </form>
                    </li>
                </ul>
            </div>
            @else
            <a href="/register" class="text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-xs px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
                Dont have an account yet?
            </a>
            <a href="/login" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                Log In
            </a>
            <button data-collapse-toggle="mobile-menu-2" type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="mobile-menu-2" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
            @endauth
        </div>
```

### Modal Implementation
