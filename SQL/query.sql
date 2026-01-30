##How to update M to F and F to M?

UPDATE users
SET gender = CASE
  WHEN gender = 'M' THEN 'F'
  WHEN gender = 'F' THEN 'M'
END;

#Find users who placed orders but never ordered the same product twice

SELECT u.id, u.name
FROM users u
JOIN orders o ON o.user_id = u.id
JOIN order_items oi ON oi.order_id = o.id
GROUP BY u.id, u.name
HAVING COUNT(*) = COUNT(DISTINCT oi.product_id);

#Total Purchase Amount in Last 30 Days

SELECT SUM(total_amount) AS total_sales
FROM orders
WHERE created_at >= NOW() - INTERVAL 30 DAY;
