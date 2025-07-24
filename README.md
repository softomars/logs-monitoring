# PHP Log Monitoring System

A CLI-based log monitoring tool built with PHP using solid OOP principles. It processes a log file containing job start/end times, computes durations, and reports slow or problematic jobs based on configurable thresholds via handler classes.

## Features

- Detects long-running jobs and categorizes them as `Warning` or `Error`
- Extensible design to add new rules via custom handlers
- Handler pattern with priority and `shouldBreak` logic
- Generates a report file with human-readable messages

## Requirements

- PHP 8.0 or later

## Usage

Access index.php (after modifying the input and output paths) or run the following command
```bash
php main.php --input=/path/to/logs.log --output=/path/to/report.log
```
For input and output file examples check logs.log and output.log

If you wish to log both Warning and Error when Error level is reached then return false in shouldBreak inside ErrorHandler
## Future improvements

- Input file validation
- Sorting the output report lines
- Improve directory structure (Models,Services)
- Unit testing
- Use composer autoload
- Use getter methods rather than accessing public properties
- Technical documentation
