# Gallery System Setup

## 1. SQL Table

**File:** `public_html/gallery_schema.sql`  
**Run in phpMyAdmin or MySQL CLI** (select your `car_dealer` database):

```sql
CREATE TABLE IF NOT EXISTS gallery (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) DEFAULT NULL,
  description TEXT DEFAULT NULL,
  image VARCHAR(255) NOT NULL,
  status ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

## 2. File Locations

| File | Location | Purpose |
|------|----------|---------|
| **SQL** | `public_html/gallery_schema.sql` | Run once to create table |
| **Admin - Add** | `public_html/admin/gallery-add.php` | Add new gallery item + image |
| **Admin - Manage** | `public_html/admin/gallery-manage.php` | List items, edit/delete buttons |
| **Admin - Edit** | `public_html/admin/gallery-edit.php` | Edit item + replace image |
| **Admin - Delete** | `public_html/admin/gallery-delete.php` | Delete item + remove folder |
| **Public** | `public_html/gallery.php` | Display active gallery with modal |

## 3. Upload Path

Images are stored at:  
`/assets/uploads/gallery/{id}/filename.ext`

## 4. Admin Updates Applied

- **First admin (public_html/admin):** Removed Car Add / Manage (linked to list-html). Added Gallery Add / Manage.
- **Second admin (list-html/admin):** Removed Blog Add / Manage. Kept only Cars.
- **Admin theme:** Changed from green to blue (#2563eb), no gradients.

## 5. Usage

1. Run the SQL script in phpMyAdmin.
2. Login to admin: `/admin/login.php`
3. Use "Add Gallery" or "Manage Gallery" from dashboard.
4. Public gallery: `/gallery.php`
