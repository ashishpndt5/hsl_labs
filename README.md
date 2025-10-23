1. Installation Instructions
	git clone https://github.com/yourusername/nxp_hsl_dashboard.git
	cd nxp_hsl_dashboard	
	
2. Install PHP dependencies
	Make sure you have PHP ≥ 8.1, Composer, and MySQL installed.
	from bash / shell command -> composer install
	
3. Set up environment file

	run from terminal -> cp .env.example .env
	open .env and update below things
	DB_DATABASE=hslabs_wholesale
	DB_USERNAME=root
	DB_PASSWORD=
	
4. Generate the application key
	from terminal run: 
	php artisan key:generate
	
5. Database Setup
	from terminal run:
	php artisan migrate
	php artisan db:seed
	
6. Run the application
	from terminal run:
	php artisan serve
	if want to run in local machine then open in local machine browser like chrome: 
	http://localhost/nxp_hsl_dashboard/public/products
	
	Enter the quantity for desired product to add or reduce.
	Submit the form.
	
7. Run Tests
	php artisan test
	or
	php artisan test --filter=ProductStockUpdateTest