-- Selects id and value from the duplicates table
SELECT id, value
FROM duplicates
-- Filters rows where the value appears more than once
WHERE value IN (
    -- Subquery: Selects distinct values with count greater than 1 (i.e., duplicates)
    SELECT value
    FROM duplicates
    -- Groups values together
    GROUP BY value
    -- Filters groups to only include those with count greater than 1 (i.e., duplicates)
    HAVING COUNT(*) > 1
);
