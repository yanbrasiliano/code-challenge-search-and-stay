
## Technical Challenge
This repository stores the technical test for the position of backend developer at Search and Stay Company.

## Stack Used
- Laravel 11
- Laravel Sail
- PHP 8.3
- MySQL 8.0
- Pest PHP 

### Setting Up the Project with Laravel Sail
Laravel Sail provides a simple Docker-based development environment for your Laravel applications. To upload and start the project using Laravel Sail, follow these steps:

1. Clone the repository to your local machine:
   ```bash
   git clone git@github.com:yanbrasiliano/code-challenge-search-and-stay.git
   cd code-challenge-search-and-stay
   ```

2. Start the Docker environment using Laravel Sail. If you don't have Sail installed globally, you can run it using the vendor binaries:
   ```bash
   ./vendor/bin/sail up
   ```

   Or if you have Laravel Sail installed globally, you can simply use:
   ```bash
   sail up
   ```

   This command will build the Docker containers for the project and start the services defined in your `docker-compose.yml` file, such as MySQL.


### How to start the application after uploading the container to Laravel Sail
1. Run the command below to create the database tables
   ```bash
   sail artisan migrate --seed
   ```

### Handling Permission Issues
If you encounter any permission issues during the setup or while running the application, use the `permissions.sh` shell script included in the repository. This script sets the correct permissions for the storage directories and other necessary files. Run the script as follows:
   ```bash
   ./permissions.sh
   ```

This will adjust the necessary permissions, allowing Laravel and Docker to access and write to the required directories.

### Running Automated PHP Pest Tests
This project uses PHP Pest for automated testing to ensure code quality and functionality. To run the tests, execute the following command within your Docker environment:
   ```bash
   ./vendor/bin/sail artisan test
   ```

   Alternatively, if you have Laravel Sail running, you can directly use:
   ```bash
   sail artisan test
   ```

These commands will run all automated tests in the `tests` directory, providing a summary of passed and failed tests. This is useful for continuous integration or checking the health of your project after changes.

### Architectural Decision
For this project, i have chosen not to utilize Domain Driven Design (DDD). In the context of Laravel, implementing DDD can often be considered "overengineering", particularly for projects where the complexity does not demand the abstractions provided by DDD. Laravel's framework already offers robust MVC architecture and built-in functionalities that adequately support the requirements of this technical test. This decision allows us to maintain simplicity and clarity while fully leveraging Laravel's native capabilities to deliver a well-structured and efficient solution.

## Authenticated API Routes Overview

The authenticated API routes are secured using Laravel Sanctum, providing token-based authentication to protect sensitive operations and ensure that only authenticated users can access specific functionalities.

### How do I log into the application via API Client (Postman, Insomnia...) ?  
To log into the application via an API client, you need to send a POST request to the `/v1/login` endpoint with the user's email and password. The API will authenticate the user and return an access token that you can use to access authenticated routes.

The email and password is provide in the UserSeeder.php file.
- **Email:** admin@admin.com
- **Password:** admin

### Specific Authenticated Routes

#### 1. Logout
- **Endpoint:** `POST /v1/logout`
- **Controller:** `AuthenticateController@logout`
- **Description:** This route handles user logout by revoking the current access token, an essential security feature that allows users to actively terminate sessions.

#### 2. **Resource Routes for Books**
- **Endpoints:**
  - `GET /v1/books` - List all books (index)
  - `POST /v1/books` - Create a new book (store)
  - `GET /v1/books/{id}` - Show a specific book (show)
  - `PUT/PATCH /v1/books/{id}` - Update a specific book (update)
  - `DELETE /v1/books/{id}` - Delete a specific book (destroy)
- **Controller:** `BookController`
- **Description:** These routes provide full CRUD operations for books, allowing the creation, retrieval, updating, and deletion of book records, facilitating the management of book resources within the application.

#### 3. **Resource Routes for Stores**
- **Endpoints:**
  - `GET /v1/stores` - List all stores (index)
  - `POST /v1/stores` - Create a new store (store)
  - `GET /v1/stores/{id}` - Show a specific store (show)
  - `PUT/PATCH /v1/stores/{id}` - Update a specific store (update)
  - `DELETE /v1/stores/{id}` - Delete a specific store (destroy)
- **Controller:** `StoreController`
- **Description:** Similar to books, these routes manage CRUD operations for store entities, facilitating the management of store data within the system.

#### 4. **Active and Inactive Stores**
- **Endpoints:**
  - `GET /v1/stores/active` - List all active stores
  - `GET /v1/stores/inactive` - List all inactive stores
- **Controller:** `StoreController`
- **Description:** These routes allow querying stores based on their active status. The `/active` endpoint lists all stores currently active, whereas the `/inactive` endpoint lists all stores that are not active, supporting effective management and visibility of store states.

#### 5. **Book-Store Relationship Management**
- **Endpoints:**
  - `GET /v1/books/{bookId}/stores` - List all stores associated with a specific book
  - `POST /v1/books/{bookId}/stores/{storeId}` - Attach a store to a specific book
  - `DELETE /v1/books/{bookId}/stores/{storeId}` - Detach a store from a specific book
  - `GET /v1/stores/{storeId}/books` - List all books available in a specific store
- **Controllers:** `BookController` and `StoreController`
- **Description:** These routes handle the many-to-many relationship between books and stores, allowing users to associate books with stores and vice versa, supporting complex relational data management.

#### 6. **User Information**
- **Endpoint:** `GET /v1/user`
- **Function:** Inline within the route definition
- **Description:** This route provides a way to fetch the currently authenticated user's information, useful for verifying login status and user details in front-end applications.

### Remarks

#### 1. Default Active State for New Stores
- **Details:** When a new store is created, it is set to be active by default.
- **Implementation Logic:** This approach simplifies the process of adding new stores to the system and ensures that they are immediately available for transactions and interactions without requiring an additional step to activate them. This can be particularly useful in systems where the majority of new stores are expected to commence operations soon after registration.
- **Reason:** Setting stores to be active by default streamlines operations and reduces the overhead of manually activating each new store. This is beneficial for business dynamics where rapid scaling and quick integration of new outlets are critical.

### 2. Use Laravel 11 with Structure Laravel 10 and PHP 8.3 Features
- **Details:** The project uses Laravel 11 with the structure of Laravel 10 and PHP 8.3 features.
- **Reason:** Laravel 11 provides the latest features, improvements, and security updates for the Laravel framework, ensuring that the application benefits from the latest advancements in the ecosystem. By combining Laravel 11 with the structure of Laravel 10, we maintain a familiar and consistent codebase that aligns with Laravel's best practices and conventions. Additionally, leveraging PHP 8.3 features enhances performance, security, and maintainability, enabling efficient development and robust application functionality.
- **Benefits:** This approach allows us to harness the power of Laravel's latest version while preserving the structure and organization of Laravel 10, providing a seamless upgrade path and ensuring compatibility with existing codebases. The integration of PHP 8.3 features further enhances the application's capabilities and performance, delivering a modern and efficient development environment.
- **Impact:** By adopting Laravel 11 with the structure of Laravel 10 and PHP 8.3 features, we can leverage the latest technologies and tools to build scalable, secure, and high-performance applications that meet the evolving needs of users and businesses. This approach ensures that the application remains up-to-date, efficient, and well-maintained, enabling continuous innovation and growth in the digital landscape.
- **Reason:** The decision to use Laravel 11 with the structure of Laravel 10 and PHP 8.3 features reflects a strategic choice to balance the benefits of the latest technologies with the stability and reliability of established frameworks and practices. This approach ensures that the application remains robust, secure, and performant while leveraging the advancements and improvements offered by Laravel 11 and PHP 8.3. 