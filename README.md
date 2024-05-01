
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

   This command will build the Docker containers for the project and start the services defined in your `docker-compose.yml` file, such as MySQL, Redis, etc.

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
