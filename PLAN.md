PLANNING DOCUMENT

1. Understanding of the Project Scope

	This project involves building a web-based dashboard (using Laravel 10 a modern frontend like Vue.js or React or Blade + Livewire) for Licensed Providers (plastic surgeons) to manage their supplement product.

	The dashboard must allow:

		Licensed Providers and their staff to order, track, and manage product inventory.

		Track patient surgical timelines and automatically align supplement subscriptions around surgery dates.

		Manage recurring subscriptions/payments for patients for (e.g renewals every month).

		Real-time visibility into patient data, order history, payments, billing and inventory.

		Integration with a payment gateway (Stripe, PayPal, etc.) and possibly inventory APIs.

		Essentially, this will be a multi-role business management portal for a B2B2C model.

2. Assumptions

	To define scope boundaries, these are the key assumptions:

	a. User Roles:

		HSL Labs (Admin)

		Licensed Providers (Surgeons)

		Provider Staff (Sub-users under each provider)

		Patients (End customers)

	b. Authentication
		
		HSL Labs have Admin login.
		
		Providers and staff use email/password login.
		
		Patients may have access to a limited patient portal (optional).

	c. Payment & Subscription

		Use Laravel Cashier (Stripe) for recurring payments.

		Subscription starts automatically relative to surgery date.

	d. Inventory

		Provider maintains local stock managed via the dashboard panel.

		HSL Labs backend tracks master product inventory.

	e. Infrastructure

		Hosted on AWS (EC2 + RDS + S3 + CloudWatch).

		Scalable to handle high number of users (multi-tenant optimized DB).

	f. Security

		All sensitive patient and transaction data encrypted.

		Role-based access control (Laravel Gates & Policies).

3. Main Components / Modules :
	Module	Purpose:						Key Features:
	Authentication & Role Management	  	Separate login for HSL Admin, Providers, Staff, Patients, 2FA, password reset.
	Provider Dashboard					  	Overview of inventory, patient activity, and payments.
	Inventory Management				  	Order supplements from HSL Labs, view stock levels, reorder alerts.
	Patient Management					  	Add/track patients, link to surgery date, manage supplement plans.
	Subscription & Payment					Manage recurring billing, auto-renewals, and payment logs.
	Order Management						Providers can place and track product orders with HSL Labs.
	Analytics / Reporting					Monthly sales, patient renewals, stock usage reports, etc.
	Notifications System					Email/SMS reminders for renewals, low stock, or patient milestones.
	Admin Backend (HSL Labs)				Manage providers, monitor inventory distribution, view orders and billing overview.

4. Key Questions to Ask Before Starting

	a. Data Structure & Access

		Will patients have their own login or just be managed by providers?

		Do providers see only their own patients, or aggregated analytics?
		
		How many users will be registered over an year.

	b. Payment Processing

		Which payment gateway is approved (Stripe, Authorize.net, etc.)?

		Who holds the merchant account—HSL Labs ?

	c. Inventory Flow

		Does HSL Labs fulfill provider orders manually or via system integration (API)?

		Is there product batch tracking required (for compliance)?

	d. Timeline and Scale

		What’s the expected launch timeline for MVP?

		How many providers/patients expected in first year/quater?

	e. Compliance

		Any HIPAA or medical data privacy requirements?

	f. Design & Branding

		Is there an existing UI/UX style guide?

		Should the dashboard be mobile responsive or app-based later?

5. Simple Milestone Timeline
	Phase	 								Duration (approx.)	Deliverables
	Phase 1: Discovery & Architecture		1 weeks			Requirements validation, ERD, API design, wireframes
	Phase 2: Auth & Role Management			1 week				Multi-role authentication, access control setup
	Phase 3: Provider Dashboard + Inventory	2 weeks				CRUD for inventory, orders, product linking
	Phase 4: Patient + Subscription Modules	1-2 weeks			Patient records, subscription setup, payment integration
	Phase 5: Reporting & Analytics			1–2 weeks			Charts for sales, renewals, inventory usage
	Phase 6: Admin (HSL Labs) Panel			1–2 weeks			Manage providers, audit logs, data export
	Phase 7: Testing, QA & Deployment		1 week				UAT, bug fixing, AWS deployment
	Total Estimate:							7-8 weeks			MVP ready for production
	
	