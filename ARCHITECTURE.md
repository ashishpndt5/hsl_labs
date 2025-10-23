ARCHITECTURE OVERVIEW

+-------------------+
|   providers       |
+-------------------+
| id (PK)           |
| name              |
| email             |
| phone             |
| clinic_name       |
| address           |
| created_at        |
| updated_at        |
+-------------------+
          |
          | 1---* (one provider has many staff)
          |
+-------------------+
| provider_staff    |
+-------------------+
| id (PK)           |
| provider_id (FK)  |
| name              |
| email             |
| role              |
| created_at        |
| updated_at        |
+-------------------+

          |
          | 1---* (one provider has many patients)
          |
+-------------------+
| patients          |
+-------------------+
| id (PK)           |
| provider_id (FK)  |
| name              |
| email             |
| phone             |
| description       |
| surgery_date      |
| created_at        |
| updated_at        |
+-------------------+
          |
          | 1---* (a patient can have multiple subscriptions)
          |
+-------------------+
| subscriptions     |
+-------------------+
| id (PK)           |
| patient_id (FK)   |
| provider_id (FK)  |
| plan_type         |  (e.g., 4-month or 12-month)
| start_date        |
| end_date          |
| status            |  (active, inactive, cancelled)
| renewal_date      |
| created_at        |
| updated_at        |
+-------------------+
          |
          | 1---* (subscription has many orders)
          |
+-------------------+
| orders            |
+-------------------+
| id (PK)           |
| subscription_id(FK)|
| provider_id (FK)  |
| patient_id (FK)   |
| total_amount      |
| payment_status    |
| order_date        |
| created_at        |
| updated_at        |
+-------------------+
          |
          | *---* (many orders can contain many inventory items)
          |
          
+-------------------+
| order_items       |
+-------------------+
| id (PK)           |
| order_id (FK)     |
| inventory_id (FK) |
| quantity          |
| unit_price        |
| created_at        |
| updated_at        |
+-------------------+

+-------------------+
| inventory         |
+-------------------+
| id (PK)           |
| provider_id (FK)  |
| product_name      |
| sku               |
| stock_quantity    |
| reorder_level     |
| created_at        |
| updated_at        |
+-------------------+

The system wil be designed to help plastic surgeons (Licensed Providers) and their staff manage supplement product sales to their patients.
Provider have a clinic where Provider Staff assist in handling patients and orders.
Patients are linked to their respective providers and can be enrolled in Subscriptions, which define recurring supplement plans tied to surgery timelines.
Each Subscription can generate multiple Orders over time as the patient receives their monthly supplies.
Orders are recorded in the Orders table, and the specific items within each order are detailed in Order_Items, connecting to the Inventory table.
Inventory tracks each provider’s available supplement stock, allowing them to reorder when quantities drop below set thresholds.
The HSL Labs admin can monitor all providers, ensuring they maintain stock levels and fulfill patient subscriptions on schedule.
Payment processing and renewals integrate seamlessly into the order workflow, providing a complete business management solution.


PROJECT STRUCTURE:

	laravel_hsl_dashboard/
	├── app/
	│   ├── Models/
	│   │   ├── Provider.php
	│   │   ├── ProviderStaff.php
	│   │   ├── Patient.php
	│   │   ├── Subscription.php
	│   │   ├── Order.php
	│   │   ├── OrderItem.php
	│   │   └── Inventory.php
	│   ├── Http/
	│   │   ├── Controllers/
	│   │   │   ├── ProviderController.php
	│   │   │   ├── PatientController.php
	│   │   │   ├── SubscriptionController.php
	│   │   │   ├── OrderController.php
	│   │   │   └── InventoryController.php
	│   │   └── Middleware/
	│   └── Providers/
	│       └── AppServiceProvider.php
	├── database/
	│   ├── migrations/
	│   │   ├── create_providers_table.php
	│   │   ├── create_patients_table.php
	│   │   ├── create_subscriptions_table.php
	│   │   ├── create_orders_table.php
	│   │   ├── create_order_items_table.php
	│   │   └── create_inventory_table.php
	│   └── seeders/
	├── routes/
	│   ├── web.php
	│   └── api.php
	├── resources/
	│   ├── views/
	│   │   ├── dashboard.blade.php
	│   │   ├── patients/
	│   │   ├── orders/
	│   │   └── inventory/
	│   └── js/ (if using Vue or Livewire)
	└── config/
		└── app.php

I have designed in this way as this is a standard way to design an application and in future we can scale it as per requirement.