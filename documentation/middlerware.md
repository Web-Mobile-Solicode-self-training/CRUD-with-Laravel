### Route Protection with Middleware

- A **middleware** is a filter that runs before accessing a route, allowing you to check certain conditions (e.g., whether the user is logged in).  
- The **`auth`** middleware protects routes so that only authenticated users can access them.  
- I added the protection for `/admin` in the **`routes/web.php`** file by placing the route inside a **route group** with `middleware('auth')`.
