-- Data Cleaning --
SELECT *
FROM layoffs;

CREATE TABLE layoffs_stage
LIKE layoffs;

SELECT *
FROM layoffs_stage;

INSERT layoffs_stage
SELECT *
FROM layoffs;


SELECT *,
ROW_NUMBER() OVER(
PARTITION BY company, location, industry, total_laid_off, percentage_laid_off, `date`, stage, country, funds_raised_millions) AS row_num
FROM layoffs_stage;

WITH CTE_layoff AS
(
SELECT *,
ROW_NUMBER() OVER(
PARTITION BY company, location, industry, total_laid_off, percentage_laid_off, `date`, stage, country, funds_raised_millions) AS row_num
FROM layoffs_stage
)
DELETE *
FROM CTE_layoff
WHERE row_num > 1;





CREATE TABLE `layoffs_stage2` (
  `company` text,
  `location` text,
  `industry` text,
  `total_laid_off` int DEFAULT NULL,
  `percentage_laid_off` text,
  `date` text,
  `stage` text,
  `country` text,
  `funds_raised_millions` int DEFAULT NULL,
  `row_num` INT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


SELECT *
FROM layoffs_stage2
WHERE row_num > 1;

INSERT INTO layoffs_stage2
SELECT *,
ROW_NUMBER() OVER(
PARTITION BY company, location, industry, total_laid_off, percentage_laid_off, `date`, stage, country, funds_raised_millions) AS row_num
FROM layoffs_stage;

DELETE
FROM layoffs_stage2
WHERE row_num > 1;


SELECT *
FROM layoffs_stage2
WHERE company = 'Casper';


-- Standardizing data(finding & fixing issues) --

SELECT company, TRIM(company)
FROM layoffs_stage2;


UPDATE layoffs_stage2
SET company = TRIM(company);

SELECT *
FROM layoffs_stage2
WHERE industry LIKE 'Crypto%';

UPDATE layoffs_stage2
SET industry = 'Crypto'
WHERE industry LIKE 'Crypto%';

SELECT DISTINCT country
FROM layoffs_stage2
ORDER BY 1;

SELECT country, TRIM(TRAILING '.' FROM country)
FROM layoffs_stage2
ORDER BY 1;

UPDATE layoffs_stage2
SET country = TRIM(TRAILING '.' FROM country)
WHERE country LIKE 'United States%';

SELECT `date`,
STR_TO_DATE(`date`, '%m/%d/%Y')
FROM layoffs_stage2
;

UPDATE layoffs_stage2
SET `date` = STR_TO_DATE(`date`, '%m/%d/%Y');

SELECT `date`
FROM layoffs_stage2;

ALTER TABLE layoffs_stage2
MODIFY COLUMN `date` DATE;

SELECT *
FROM layoffs_stage2
WHERE industry IS NULL
OR industry = '';

UPDATE layoffs_stage2
SET industry = NULL
WHERE industry = '';

SELECT *
FROM layoffs_stage2
WHERE company LIKE 'Juul%';

SELECT *
FROM layoffs_stage2 t1
JOIN layoffs_stage2 t2
	ON t1.company = t2.company
WHERE t1.industry IS NULL AND t2.industry IS NOT NULL;

UPDATE layoffs_stage2 t1
JOIN layoffs_stage2 t2
	ON t1.company = t2.company
SET t1.industry = t2.industry
WHERE t1.industry IS NULL AND t2.industry IS NOT NULL;

SELECT *
FROM layoffs_stage2
WHERE total_laid_off IS NULL
AND percentage_laid_off IS NULL;

DELETE
FROM layoffs_stage2
WHERE total_laid_off IS NULL
AND percentage_laid_off IS NULL;

SELECT *
FROM layoffs_stage2;

ALTER TABLE layoffs_stage2
DROP COLUMN row_num;


