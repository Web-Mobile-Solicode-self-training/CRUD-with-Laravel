# Livrable: Authentication & Authorization Planning for Laravel Blog (Version 6)

## 1. List of Blog Areas with Access Types
| Area                  | URL                          | Desired Access Type |
|-----------------------|------------------------------|---------------------|
| Blog Home            | `/`                         | Public (everyone)  |
| Article List         | `/articles`                 | Public             |
| Single Article Page  | `/articles/{slug}`          | Public             |
| Admin Dashboard      | `/admin`                    | Protected (logged-in users only) |
| Create Article       | `/admin/articles/create`    | Protected (specific roles: Author/Admin) |
| Delete Article       | `/admin/articles/{id}/delete` | Protected (specific roles: Author for own, Admin for all) |

## 2. List of Roles
| Role    | Short Description |
|---------|-------------------|
| Visitor | Non-logged-in person who can read public articles. |
| Author  | Logged-in user who can write and manage their own articles. |
| Admin   | Logged-in user who manages the entire blog (all articles, users, etc.). |

## 3. "Who Can Do What?" Matrix (Roles × Actions)
| Action                      | Visitor | Author | Admin |
|-----------------------------|---------|--------|-------|
| Read public articles        | ✔️      | ✔️     | ✔️    |
| Access /admin               | ❌      | ✔️     | ✔️    |
| Create an article           | ❌      | ✔️     | ✔️    |
| Edit own articles           | ❌      | ✔️     | ✔️    |
| Delete own articles         | ❌      | ✔️     | ✔️    |
| Delete any article          | ❌      | ❌     | ✔️    |

## 4. Linking Rules to Laravel Tools
The business rules above will be implemented using Laravel's security features. Authentication (knowing "who" via login/logout) will use **Laravel UI** to handle user sessions and `Auth::user()`. Basic protection for protected areas (e.g., blocking Visitors from `/admin`) will apply the **auth middleware** on routes. Role distinctions (e.g., Author vs. Admin) will check the `is_admin` database field. Fine-grained rules, like allowing Authors to delete only their own articles, will use **Gates** (simple checks) or **Policies** (class-based) to enforce the matrix—e.g., a Gate for "delete-article" that verifies ownership or admin status. This ensures secure, role-based access without hardcoding everywhere.