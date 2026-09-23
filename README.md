# SQL Data Cleaning Project
 
## Project Overview
 
This project demonstrates data cleaning techniques using MySQL.
 
The dataset contains company layoff information. The cleaning process includes:
 
- Removing duplicates
- Standardizing company names
- Standardizing industry values
- Formatting dates
- Handling null values
- Removing unnecessary rows and columns
 
## SQL Skills Demonstrated
 
- CTEs
- Window Functions
- ROW_NUMBER()
- Joins
- Data Standardization
- Data Cleaning
- Date Conversion
- Table Creation
- Data Validation
 
## Cleaning Steps
 
### 1. Create Staging Table
 
A copy of the original dataset was created to preserve the raw data.
 
### 2. Remove Duplicates
 
Duplicates were identified using:
 
```sql
ROW_NUMBER() OVER(
PARTITION BY company, location, industry,
total_laid_off, percentage_laid_off,
date, stage, country, funds_raised_millions
)

## Author

Ivaldo Gilson Jorge Chilundo
