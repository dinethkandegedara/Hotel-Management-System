-- ============================================
-- OCEAN VIEW HOTEL - SQL VERIFICATION SCRIPT
-- Run this to verify database is set up correctly
-- ============================================

USE hotel;

-- Check all tables exist
SELECT 'Checking Tables...' as Status;
SELECT 
    TABLE_NAME, 
    TABLE_ROWS,
    CREATE_TIME
FROM information_schema.TABLES 
WHERE TABLE_SCHEMA = 'hotel'
ORDER BY TABLE_NAME;

-- Verify room table structure
SELECT 'Checking Room Table Columns...' as Status;
DESCRIBE room;

-- Count records in each table
SELECT 'Record Counts...' as Status;
SELECT 'contact' as TableName, COUNT(*) as RecordCount FROM contact
UNION ALL
SELECT 'login', COUNT(*) FROM login
UNION ALL
SELECT 'room', COUNT(*) FROM room
UNION ALL
SELECT 'foods', COUNT(*) FROM foods
UNION ALL
SELECT 'food_orders', COUNT(*) FROM food_orders
UNION ALL
SELECT 'roombook', COUNT(*) FROM roombook
UNION ALL
SELECT 'payment', COUNT(*) FROM payment;

-- Show sample room types
SELECT 'Sample Room Types (should be 12)...' as Status;
SELECT id, type, bedding, place FROM room ORDER BY id;

-- Show sample food items
SELECT 'Sample Food Items (should be 23)...' as Status;
SELECT id, name, category, price FROM foods ORDER BY category, name;

-- Verify admin login exists
SELECT 'Admin Login Check...' as Status;
SELECT id, username, 
    CASE WHEN password = 'admin' THEN '✓ Default password set' ELSE '✗ Password changed' END as PasswordStatus
FROM login WHERE username = 'admin';

-- Check indexes
SELECT 'Indexes Created...' as Status;
SELECT 
    TABLE_NAME,
    INDEX_NAME,
    COLUMN_NAME
FROM information_schema.STATISTICS
WHERE TABLE_SCHEMA = 'hotel'
ORDER BY TABLE_NAME, INDEX_NAME;

SELECT '✅ Database Verification Complete!' as Status;
