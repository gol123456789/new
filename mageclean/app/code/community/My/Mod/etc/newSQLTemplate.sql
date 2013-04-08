SELECT COUNT(*) 
FROM (SELECT 
MAX(DATE_FORMAT(period, '%Y-%m-%d')) AS `period`, 
SUM(qty_ordered) AS `qty_ordered`, `sales_bestsellers_aggregated_yearly`.`product_id`, 
MAX(product_name) AS `product_name`, 
MAX(product_price) AS `product_price` 
FROM `sales_bestsellers_aggregated_yearly` 
WHERE (
EXISTS (
SELECT 1 FROM `catalog_product_entity` AS `existed_products` 
WHERE (sales_bestsellers_aggregated_yearly.product_id = existed_products.entity_id))) 
AND (store_id IN(0)) 
GROUP BY `product_id` LIMIT 5) 
AS `t`


SELECT 
DISTINCT 
IF(synonym_for IS NOT NULL AND synonym_for != '', synonym_for, query_text) AS `name`, 
`main_table`.`num_results`, 
`main_table`.`popularity` 
FROM `catalogsearch_query` AS `main_table` 
ORDER BY
`popularity` desc, 
`name` ASC LIMIT 5