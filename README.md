<div align=center>

# Framework Base Programming <br> Midterm Exam Recipe Web
Fayza Aqila Bachtiar - 5025221087 <br>
Tabina Callistadya - 5025221318

</div> 

### Overview
The midterm exam requires us to work as a group on a website programmed using laravel framework and a development environment, by implementing CRUD features.

## Database
### PDM

[pdm image]

## Model
From the database we have provided before, there are 5 models according to our databases respectively. [category.php](/app/Models/Category.php), [course.php](/app/Models/Course.php), [food.php](/app/Models/Food.php), [recipe.php](/app/Models/Recipe.php), and [user.php](/app/Models/User.php). 

Within the models are where we declared the relationship of each models to one another.
- `category`
    ```php
    public function foods(): HasMany {
        return $this->hasMany(Food::class, 'category_id');
    }

    public function recipes(): HasMany {
        return $this->hasMany(Recipe::class, 'category_id');
    }
    ```
- `course`
    ```php
    public function foods(): HasMany {
        return $this->hasMany(Food::class, 'course_id');
    }

    public function recipes(): HasMany {
        return $this->hasMany(Recipe::class, 'course_id');
    }
    ```
- `food`
    ```php
    public function course(): BelongsTo {
        return $this->belongsTo(Course::class);
    }

    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }
    ```
- `recipe`
    ```php
    public function course(): BelongsTo {
        return $this->belongsTo(Course::class);
    }

    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }
    ```
both category and course model have many foods and recipes within them. As for the food and recipe model, they belong to each course and each category as their own. From this relation we can conclude that the relation between those tables are one to many.

another added feature in the model may be the searching function in the food model, where it implement `scopeFilter` function.

```php
public function scopeFilter(Builder $query, array $filters): void {
    $query->when(
        $filters['search'] ?? false,
        fn ($query, $search) =>
        $query->where('name', 'like', '%' . $search . '%')
    );

    $query->when(
        $filters['category'] ?? false,
        fn ($query, $category) =>
        $query->whereHas('category', fn ($query) => $query->where('slug', $category))
    );

    $query->when(
        $filters['course'] ?? false,
        fn ($query, $course) =>
        $query->whereHas('course', fn ($query) => $query->where('name', $course))
    );
}
```
this function allows the searching link to have certain format when called. allowing the user to have proper links as they navigate through the web.

## View
View is the display of our website. Where moreover consisting of each pages UI display and their differences when accessed by guest or an authenticated user.

### Components
mostly are the usual components element such as [guest.layout.php](/resources/views/components/guess.blade.php), [layout.blade.php](/resources/views/components/layout.blade.php), and [navbar.blade.php](/resources/views/components/navbar.blade.php). To highlight differences of our website with the weekly laravel assignment shall be the authentication feature and modal implementations in the `navbar`.

- **authentication**
    
    guest user and authenticated user have different access in our website, all to ensure people will register to our website, due to special features our website provide permits to only authenticated users.

    **as guest**

    [navbar image before auth]

    **as authenticated user**

    [navbar image after auth auth]

    The first authentication feature used is to determine the routing for the navbar. If thee user is authorized, they will be routed to recipes page, but if it is not (guest), it will be routed to the login page first.

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
    The second authentication feature is to determine which button will be displayed in the user UI on the top right corner. If it is authenticated, it will display a button named "Add Recipe" that is used for the user to add their own recipe to the website. Theres also a profile that has a dropdown menu containing "Profile" that will navigate to the profile page and "Log Out" to terminate/destroy the user session. But if its not authenticated, then it will display 2 button. Which are "Log In" that will route to the login page and "Dont have an account yet?" that will route to the register page.

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

- **Modal Implementation**
    
    modal implementations are set of 'function' that are called navigated from the form submisions. those are the `add recipe` and `profile` button, both located in the [navbar.blade.php](/resources/views/components/navbar.blade.php)

    - php
    ```php
    <div id="updateProductModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <!-- Modal header -->
                <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Add Recipe
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="updateProductModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="/recipe/store" method="POST">
                    @csrf
                    <div class="mb-4">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                            <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Recipe Name">
                        </div>
                    </div>
                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                        <div>
                            <label for="course" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Course</label>
                            <input type="text" name="course" id="brand" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Appetizer/Main/Dessert/Snack">
                        </div>
                        <div>
                            <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                            <input type="text" name="category" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Vegan/Meat/Seafood/Non diary">
                        </div>
                        <div>
                            <label for="est_price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                            <input type="text" name="est_price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="1,000-99,000">
                        </div>

                        <div class="sm:col-span-2">
                            <label for="content" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Recipe</label>
                            <input id="description" type="text" name="content" rows="5" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Write a description..."></input>                    
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button type="submit" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            save recipe
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    ```

    - javascript
    ```js
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            document.getElementById('defaultModalButton').click();
        });
    </script>
    ```
<br>

**add recipe button pop up UI**
<img width="1470" alt="Screenshot 2024-10-17 at 23 35 26" src="https://github.com/user-attachments/assets/721c46b7-a591-40ff-821d-201580f5f334">

<br>

### Model-Views
model-view involves in the pages that has the CRUD features, that includes [recipes.blade.php](/resources/views/recipes.blade.php) (and their single-post view [recipe.blade.php](/resources/views/recipe.blade.php)) as well as [Myrecipe.blade.php](/resources/views/Myrecipe.blade.php) (and their 'bridging'-view [profile.blade.php](/resources/views/profile.blade.php)).

**Recipes Page**
<img width="1470" alt="Screenshot 2024-10-17 at 23 34 20" src="https://github.com/user-attachments/assets/c9cc2b98-9a97-4670-8b4d-a9dcd1985f45">

<img width="1470" alt="Screenshot 2024-10-17 at 23 34 39" src="https://github.com/user-attachments/assets/0029c90b-3659-4945-95d0-7f5cf17cadd3">

<br>

**Single-post Recipe page**
<img width="1470" alt="Screenshot 2024-10-17 at 23 34 54" src="https://github.com/user-attachments/assets/8b844728-1b16-4c38-9320-ace6654038c8">


**Profile Page**
<img width="1470" alt="Screenshot 2024-10-17 at 23 36 16" src="https://github.com/user-attachments/assets/160fa7d0-7e80-4169-bf42-524edb40c748">

**Single-Post Personal Recipe Page**

[kapal selam image]

however, small there are also one more feature in the model-views, its loacted in the [recipes.blade.php](/resources/views/recipes.blade.php). that is the view of the searching method.

[searching  bar image]

this searching feature implements a form submition action. where it verifies the search by request.

```php
<form action="/recipes" method="get">
    @if(request('category'))
        <input type="hidden" name="category" value="{{ request('category') }}">
    @endif
    @if(request('course'))
        <input type="hidden" name="course" value="{{ request('course') }}">
    @endif
    
    ....
    ....
</form>
```

### Authentication Views
Are the [login.blade.php](/resources/views/login.blade.php) and [register.blade.php](/resources/views/register.blade.php) pages. 

**Register Page**
<img width="1470" alt="Screenshot 2024-10-17 at 23 33 22" src="https://github.com/user-attachments/assets/253920c4-4452-4faf-bb5f-9029fa586edc">

**Login Page**
<img width="1470" alt="Screenshot 2024-10-17 at 23 33 39" src="https://github.com/user-attachments/assets/790c3c04-e544-47c5-9224-e9f53fafd924">

These pages utilizes `<form>` function in recieving as well as storing data. 

- `register` 
    ```php
    <form method="POST" action="/register/store" class="space-y-4 md:space-y-3">
        @csrf
        <div>
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Full Name</label>
            <input type="name" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Full Name" required="">
        </div>
        <div>
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email Address</label>
            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required="">
        </div>
        <div>
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
            <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
        </div>
        <div>
            <label for="confirm-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm password</label>
            <input type="password" name="confirm-password" id="confirm-password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
        </div>
        <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
            Create an account
        </button>
        <p class="text-sm text-center font-light text-gray-500 dark:text-gray-400">
            Already have an account? <a href="/login" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Login here</a>
        </p>
    </form>
    ```
- `login` page
    ```php
    <form method="POST" action="/login"  class="space-y-4 md:space-y-6">
        @csrf
        <div>
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required="">
        </div>
        <div>
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
            <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
        </div>
        
        <button href="/recipes" type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
            Sign in
        </button>
        <p class="text-sm text-center font-light text-gray-500 dark:text-gray-400">
            Don’t have an account yet? <a href="/register" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Sign up</a>
        </p>
    </form>
    ```

### Other Views
Other views are the complementary views that completes our website.

**Home page / Landing Page**
[first page]

<img width="1470" alt="Screenshot 2024-10-17 at 23 31 34" src="https://github.com/user-attachments/assets/fb144bb1-eed4-4d8f-ad99-d22bac8439b9">

<img width="1470" alt="Screenshot 2024-10-17 at 23 32 18" src="https://github.com/user-attachments/assets/d2e424de-8dad-45ee-93d0-e3c990a79394">

**About Page**
[about page]

**FAQ Page**
<img width="1470" alt="Screenshot 2024-10-17 at 23 32 59" src="https://github.com/user-attachments/assets/cebc141f-7413-49dc-abaa-af9db3ede739">


## Controller
the controllers used for our website may differ from the models. However it can be divided into 2 highlights. 

### Authentication Controllers
authentication controllers are divided into two based on their functionality, [registercontroller.php](/app/Http/Controllers/RegisterController.php) and [logincontroller.php](/app/Http/Controllers/LoginController.php). 

- `registercontroller`
    ```php
    public function create() {
        return view('register');
    }

    public function store(Request $attr) {
        $attr->validate([
            'name'=>'required|string',
            'email'=>'required|string',
            'password'=> 'required|string|min:8',
            'confirm-password'=>'required|string|min:8'
        ]);

        $name = $attr->input('name');
        $email = $attr->input('email');
        $password = $attr->input('password');

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password
        ]);

        return redirect()->route('login')->with('success', 'user added successfully!');
    }
    ```
    has two functions `create` to return the view of the register page when called and function `store` to insert data of the new user account to the database, users table. It stores the inputted data as a variable and only then called by the `User::create` to be trully inserted.

- `logincontroller`
    ```php
    public function create() {
        return view('login');
    }

    public function store() {
        $attr = request()->validate([
            'email'=>['required','email'],
            'password'=>['required']
        ]);
        
        if(!Auth::attempt($attr)){
            throw ValidationException::withMessages([
                'email'=>'Sorry, credentials do not match'
            ]);
        }

        request()->session()->regenerate();
        return redirect('/');
    }

    public function destroy(){
        Auth::logout();
        return redirect('/');
    }
    ```
    whilist almost the same, the logincontroller have three functions, `create` to return the view, `store` to get the data (not to push to database, but to generate a user session accessing the website) and lastly function `destroy` to initiate the user logout system.

to enable this funtions within the controller is to also initiate them within the routing [web.php](/routes/web.php).

```php
Route::middleware(['guest'])->group(function() {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register/store',[RegisterController::class, 'store'])->name('register.store');

    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
});

Route::post('/logout',[LoginController::class,'destroy']);
```
using `middleware` to differenciate which of them are `guest` or an authenticated user. 

### Recipe Controller 
for recipe controller, all the more likely similar to the register controller, due to the capability inserting new user-input data to the database.

```php
public function store(Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'course' => 'required|string',
        'category' => 'required|string',
        'est_price' => 'required|string',
        'content' => 'required|string'  
    ]);
    
    $coursevar = $request->input('course'); 
    $courseId = Course::where('name', $coursevar)->first()->id;

    $categoryvar = $request->input('category'); 
    $categoryId = Category::where('name', $categoryvar)->first()->id;


    $name = $request->input('name');
    $course_id = $courseId;
    $category_id = $categoryId;
    $slug = Str::slug($name);
    $est_price = $request->input('est_price');
    $content = $request->input('content');

    Recipe::create([
        'name' => $name,
        'course_id' => $course_id,
        'category_id' => $category_id,
        'slug' => $slug,
        'est_price' => $est_price,
        'content' => $content
    ]);

    return redirect()->back()->with('success', 'Recipe added successfully!');
}

public function destroy($id) {
    $recipe = Recipe::findOrFail($id); 
    $recipe->delete(); 
    return redirect()->route('profile')->with('success', 'Recipe deleted successfully!');
}
```
the function `create` is to obviously enabling data insert to the database by storing user-input data to a certain variable and assinging them to each attribute to be 'created'. as for the function `destroy` is to delete the recipe data by `id`.

the routing of the recipe controller however have differences fom the authentications.
```php
Route::middleware(['auth'])->group(function() {
    Route::get('/recipes', function () {
        return view('recipes', ['foods' => $foods=Food::filter(request(['search', 'category', 'course']))->latest()->paginate(12)->withQueryString(), 
        'courses' => $courses=Course::latest()->get()]);
    });  

    Route::get('/recipes/{food:slug}', function (Food $food) {
        return view('recipe', ['food' => $food]);
    });

    Route::get('/profile', function () {
        return view('profile', ['recipes' => $recipes=Recipe::latest()->get()]);
    })->name('profile');

    Route::get('/profile/{recipe:slug}', function (Recipe $recipe) {
        return view('Myrecipe', ['recipe' => $recipe]);
    });

    Route::post('/recipe/store',[RecipeController::class,'store'])->name('recipe.store');
    Route::delete('/recipe/{id}', [RecipeController::class, 'destroy'])->name('recipe.destroy');
});
```
it still uses `middleware` but has different state, whereas the user is declared as `auth` or short for authenticated user. So this pages and capability are only accessible to authenticated users. That involves viewing the recipe page (though it displays the food database) and profile page, where the implementations of the recipecontroller is planted. 

and that is all of our report for the midterm project, thank you!!  𓆝⋆｡˚ 𓇼