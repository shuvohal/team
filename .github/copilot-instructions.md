# Copilot Instructions for AI Agents

## Project Overview
This is a basic PHP project focused on retrieving data from an SQL database. The main entry point is `index.php`.

## Key Files
- `index.php`: Main application logic. Handles database connection and data retrieval.
- `README.md`: Brief project description.

## Architecture & Data Flow
- The project is a single-file PHP application.
- Data is retrieved from an SQL database (connection details and queries are in `index.php`).
- No complex service boundaries or multi-component architecture.

## Developer Workflows
- **Run Locally:** Place the project in your web server's root (e.g., XAMPP `htdocs`). Access via browser (`http://localhost/team/team/index.php`).
- **Database Setup:** Ensure the referenced SQL database exists and is accessible. Connection parameters are hardcoded in `index.php`.
- **Debugging:** Use `echo`/`var_dump` for output. Errors will display in the browser if PHP error reporting is enabled.

## Project-Specific Conventions
- All logic is in `index.php`. No MVC or framework conventions.
- SQL queries are written directly in PHP code.
- Minimal use of external dependencies.

## Integration Points
- Relies on a local SQL database. No external APIs or services.

## Patterns & Examples
- Database connection and query logic are in `index.php`:
  ```php
  $conn = new mysqli($servername, $username, $password, $dbname);
  $result = $conn->query($sql);
  while($row = $result->fetch_assoc()) {
      // process $row
  }
  ```
- Error handling is basic; check for connection/query errors inline.

## Recommendations for AI Agents
- Focus on improving or extending `index.php` for new features.
- When adding new files, update the README with usage instructions.
- Keep code simple and readable; follow the direct PHP+SQL style.

---
For questions or unclear conventions, ask the user for clarification or examples.
