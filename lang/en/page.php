<?php

return [
    'dashboard' => [
        'header' => 'Dashboard',
        'cards' => [
            'revenues' => [
                'all' => 'All Revenues', 'collected' => 'Collected Revenues', 'uncollected' => 'Uncollected Revenues',
            ],
            'expenses' => 'Expenses',
            'bookings' => [
                'all' => 'All Bookings',
                'confirmed' => 'Confirmed Bookings',
                'temporary' => 'Temporary Bookings',
                'canceled' => 'Canceled Bookings',
                'paid' => 'Paid Bookings'
            ]
        ],
        'charts' => [
            'bar' => [
                'label' => 'Number of bookings in the last 5 months'
            ]
        ],
        'boxes' => [
            'revenues' => [
                'all' => 'All Revenues',
                'collected' => 'Collected Revenues',
                'uncollected' => 'Uncollected Revenues'
            ],
            'expenses' => [
                'all' => 'All Expenses'
            ]
        ]
    ],
    'settings' => [
        'header' => 'Settings',
        'greeting' => 'Hi, please select one of the settings on the left.'
    ],
    'users' => [
        'index' => [
            'header' => 'Users',
            'table' => ['name' => 'Name', 'email' => 'Email', 'phone' => 'Phone', 'role' => 'Role'],
        ],
        'create' => ['header' => 'Create New User'],
        'edit' => ['header' => 'Update The User :user'],
        'form' => [
            'name' => ['label' => 'Full Name', 'placeholder' => 'Please insert the user\'s full name',],
            'email' => ['label' => 'Email', 'placeholder' => 'user@example.com',],
            'phone' => ['label' => 'Phone', 'placeholder' => 'Please write the phone number with the country key'],
            'role' => [
                'label' => 'Role',
                'placeholder' => 'Please select a role',
                'items' => ['admin' => 'Admin', 'accountant' => 'Accountant', 'data_entry' => 'Data Entry']
            ],
        ],
        'flash' => [
            'created' => 'A new user with the name :user has been created',
            'updated' => 'The user :user data have been updated',
            'deleted' => 'The user :user has been deleted'
        ],
    ],
    'features' => [
        'index' => [
            'header' => 'Features',
            'table' => ['description' => 'Description',],
        ],
        'create' => ['header' => 'Create New Feature'],
        'edit' => ['header' => 'Update The Feature :feature'],
        'form' => [
            'description' => [
                'label' => 'Description',
                'placeholder' => 'Please write a simple and clear description of this feature'
            ],
            'buttons' => ['create' => 'Create', 'edit' => 'Update', 'back' => 'Back']
        ],
        'flash' => [
            'created' => 'A new feature has been created',
            'updated' => 'The feature :feature has been updated',
            'deleted' => 'The feature :featuer has been deleted'
        ],
    ],
    'offers' => [
        'index' => [
            'header' => 'Offers',
            'table' => ['#' => '#', 'description' => 'Description', 'price' => 'Price'],
        ],
        'create' => ['header' => 'Create New Offer'],
        'edit' => ['header' => 'Update The Offer :offer'],
        'form' => [
            'description' => ['label' => 'Description', 'placeholder' => 'Please write a simple and clear description of this offer'],
            'price' => ['label' => 'Price', 'placeholder' => 'Please insert the price of the offer']
        ],
        'flash' => [
            'created' => 'A new offer has been created',
            'updated' => 'The offer :offer has been updated',
            'deleted' => 'The offer :offer has been deleted'
        ],
    ],
    'packages' => [
        'index' => [
            'header' => 'Packages',
        ],
        'create' => ['header' => 'Create New Package'],
        'edit' => ['header' => 'Update The Package :package'],
        'form' => [
            'name' => ['label' => 'Name', 'placeholder' => 'Please write the package name here.'],
            'features' => ['label' => 'Features',],
            'price' => [
                'label' => 'Price',
                'placeholder' => 'Please write the package price here.',
                'note' => 'If no price inserted, then the package price will be set as 0 automatically.'
            ]
        ],
        'flash' => [
            'created' => 'A new feature has been created',
            'updated' => 'The feature has been updated',
            'deleted' => 'The feature has been deleted'
        ],
    ],
    'clients' => [
        'index' => [
            'header' => 'Clients',
            'table' => [
                'name' => 'Name',
                'phone' => 'Phone',
                'email' => 'Email',
                'domain' => 'Domain',
                'address' => 'Work Address',
                'businessField' => 'Business Field'
            ],
        ],
        'create' => ['header' => 'Create New Client'],
        'edit' => ['header' => 'Update The Client :client'],
        'form' => [
            'name' => ['label' => 'Full Name', 'placeholder' => 'Please insert the client\'s full name',],
            'email' => ['label' => 'Email', 'placeholder' => 'client@example.com',],
            'password' => ['label' => 'Password', 'placeholder' => 'Password',],
            'phone' => ['label' => 'Phone', 'placeholder' => 'Please write the phone number with the country key'],
            'address' => ['label' => 'Address', 'placeholder' => 'Please write your business location'],
            'businessField' => ['label' => 'Business Field'],
            'domain' => ['label' => 'Domain', 'placeholder' => 'ersana.com'],
        ],
        'flash' => [
            'created' => 'A new client with the name :user has been created',
            'updated' => 'The client :client data have been updated',
            'deleted' => 'The client :client has been deleted'
        ],
    ],
    'subscriptions' => [
        'index' => [
            'header' => 'Subscriptions',
            'table' => [
                '#' => '#',
                'package' => 'Package',
                'client' => 'Client',
                'status' => 'Status',
            ],
        ],
        'create' => ['header' => 'Create New Subscription',],
        'edit' => ['header' => 'Update Subscription :subscription', 'note' => ['label' => 'Note', 'content' => 'For editing client\'s halls data please refer to halls section and go to the required hall']],
        'form' => [
            'client' => ['label' => 'Client', 'placeholder' => 'Please select one of the available clients.'],
            'package' => ['label' => 'Package', 'placeholder' => 'Please select one of the available packages.'],
            'hall' => [
                'name' => ['label' => 'Hall Name', 'placeholder' => 'Please insert the name of the hall'],
                'city' => ['label' => 'Hall City', 'placeholder' => 'Please select the city where the hall is located'],
                'address' => ['label' => 'Hall Address', 'placeholder' => 'Please insert the address of the hall'],
                'button' => 'Add Client Halls'
            ]
        ],
        'flash' => [
            'created' => 'A new subscription has been created with :subscription',
            'updated' => 'The subscription :subscription has been updated',
            'deleted' => 'Subscription :subscription is deleted'
        ],
    ],
    'businessFields' => [
        'index' => [
            'header' => 'Business Fields',
            'table' => ['field' => 'Field', 'type' => 'Type'],
        ],
        'create' => ['header' => 'Create New Business Field',],
        'edit' => ['header' => 'Update :field Business Field',],
        'form' => [
            'name' => ['label' => 'Name', 'placeholder' => 'Weddings and events.'],
            'type' => ['label' => 'Type', 'placeholder' => 'Please select one of the types below.'],
        ],
        'flash' => [
            'created' => 'A new business field with the title :field has been created.',
            'updated' => 'The business field :field has been updated.',
            'deleted' => 'The business field :field has been deleted.'
        ],
        'types' => [
            'advertisement' => 'Advertisement',
            'booking' => 'Booking'
        ]
    ],
    'halls' => [
        'index' => [
            'header' => 'Halls',
            'table' => [
                '#' => '#',
                'name' => 'Name',
                'city' => 'City',
                'address' => 'Address',
                'capacity' => 'Capacity',
                'client' => 'Client',
                'period' => 'Period',
                'from' => 'From',
                'to' => 'To',
                'price' => 'Price'
            ]
        ],
        'create' => ['header' => 'Create New Hall',],
        'edit' => ['header' => 'Update :hall Hall'],
        'form' => [
            'name' => ['label' => 'Name', 'placeholder' => 'Please insert the hall name'],
            'city' => ['label' => 'City', 'placeholder' => 'Please select the city where hall is located'],
            'address' => ['label' => 'Address', 'placeholder' => 'Please insert the hall address'],
            'capacity' => ['label' => 'Capacity', 'placeholder' => 'The number of people the hall can fit', 'person' => 'Person'],
        ],
        'flash' => [
            'created' => 'A new hall has been created',
            'updated' => 'The hall :hall information has been updated',
            'deleted' => 'The hall :hall is deleted'
        ],
    ],
    'bookingTimes' => [
        'index' => [
            'header' => 'Booking Times',
            'table' => ['#' => '#', 'period' => 'Period', 'from' => 'From', 'to' => 'To', 'price' => 'Price']
        ],
        'create' => ['header' => 'Create New Booking Time'],
        'edit' => ['header' => 'Update The Booking Time :bookingTime'],
        'form' => [
            'period' => ['label' => 'Period', 'items' => ['day' => 'Day', 'evening' => 'Evening']],
            'from' => ['label' => 'From', 'placeholder' => 'Please select time'],
            'to' => ['label' => 'To', 'placeholder' => 'Please select time'],
            'price' => ['label' => 'Price', 'placeholder' => 'Please insert the booking time price']
        ],
        'flash' => [
            'created' => 'A new booking time has been created',
            'updated' => 'The booking time :bookingTime data has been updated',
            'deleted' => 'The booking Time :bookingTime is deleted',
            'unavailable' => 'Sorry! All times are booked for this period of this date'
        ],
    ],
    'customers' => [
        'index' => [
            'header' => 'Customers',
            'table' => [
                'name' => 'Name',
                'company' => 'Company',
                'email' => 'Email',
                'phone' => 'Phone',
                'address' => 'Address',
            ]
        ],
        'create' => ['header' => 'Create New Customer'],
        'edit' => ['header' => 'Update :customer Data',],
        'form' => [
            'name' => ['label' => 'Name', 'placeholder' => 'Please enter the full name'],
            'company' => ['label' => 'Company', 'placeholder' => 'Please enter the company name'],
            'email' => ['label' => 'Email', 'placeholder' => 'customer@example.com'],
            'phone' => ['label' => 'Phone', 'placeholder' => 'Please enter the phone number'],
            'address' => ['label' => 'Address', 'placeholder' => 'Please write the address',],
        ],
        'flash' => [
            'created' => 'A new customer has been created',
            'updated' => 'The customer number :customer has been updated',
            'deleted' => 'The customer :customer is deleted'
        ],
    ],
    'bookings' => [
        'index' => [
            'header' => 'Bookings',
            'table' => [
                '#' => '#',
                'customer' => 'Customer Name',
                'date' => 'Booking Date',
                'period' => 'Period',
                'from' => 'From',
                'to' => 'To',
                'total' => 'Price',
                'status' => 'Status'
            ]
        ],
        'create' => [
            'header' => 'Create New Booking',
            'customer_information' => 'Customer Information',
            'booking_times' => 'Booking Times',
            'offers' => 'Offers and Services',
            'payment' => 'Payment',
            'additional_information' => 'Additional Information'
        ],
        'show' => [
            'header' => 'Booking Number :booking',
            'name' => 'Name',
            'company' => 'Company',
            'email' => 'Email',
            'phone' => 'Phone',
            'address' => 'Address',
        ],
        'edit' => ['header' => 'Update Booking :booking Data'],
        'form' => [
            'customer' => [
                'placeholder' => 'Please select one of the customers in the list below'
            ],
            'date' => ['label' => 'Booking Date', 'placeholder' => 'Please select a date'],
            'bookingTimes' => ['label' => 'Available Booking Times', 'button' => 'Available Times'],
            'payment_method' => [
                'label' => 'Payment Method',
                'placeholder' => 'Please select the desired payment method',
                'items' => ['bank' => 'Bank Transfer', 'cash' => 'Cash']
            ],
            'paid' => ['label' => 'Paid Amount', 'placeholder' => 'Please insert the paid amount'],
            'remaining' => ['label' => 'Remaining Amount', 'placeholder' => ''],
            'total' => ['label' => 'Total'],
            'status' => [
                'label' => 'Status',
                'items' => [
                    'confirmed' => 'Confirmed',
                    'temporary' => 'Temporary',
                    'paid' => 'Paid',
                    'canceled' => 'Canceled',
                ],
            ],
            'notes' => ['label' => 'Notes', 'placeholder' => 'Please write any additional notes']
        ],
        'flash' => [
            'created' => 'A new booking is created',
            'updated' => 'The booking :booking information is updated',
            'deleted' => 'The booking :booking is deleted'
        ],
    ],
    'expenses' => [
        'index' => [
            'header' => 'Expenses',
            'table' => [
                '#' => '#',
                'date' => 'Date',
                'payment_method' => 'Payment Method',
                'amount' => 'Amount',
                'description' => 'Description',
            ]
        ],
        'create' => ['header' => 'Create New Expense'],
        'edit' => ['header' => 'Update Expense Number :expense'],
        'form' => [
            'date' => ['label' => 'Date', 'placeholder' => 'Please select date'],
            'payment_method' => [
                'label' => 'Payment Method',
                'placeholder' => 'Please select payment method',
                'items' => [
                    'cash' => 'Cash',
                    'bank' => 'Bank'
                ],
            ],
            'amount' => ['label' => 'Amount', 'placeholder' => 'Please insert amount'],
            'description' => ['label' => 'Description', 'placeholder' => 'Please write a detailed description']
        ],
        'flash' => [
            'created' => 'A new expense has been created',
            'updated' => 'The expense number :expense has been updated',
            'deleted' => 'The expense :expense is deleted',
            'failed' => 'The expense could not be save because of the following errors',
        ],
    ],
    'revenues' => [
        'index' => [
            'header' => 'Revenues',
            'table' => [
                '#' => '#',
                'date' => 'Date',
                'payment_method' => 'Payment Method',
                'amount' => 'Amount',
                'description' => 'Description',
            ]
        ],
        'create' => ['header' => 'Create New Revenue'],
        'edit' => ['header' => 'Update revenue Number :revenue'],
        'form' => [
            'date' => ['label' => 'Date', 'placeholder' => 'Please select date'],
            'payment_method' => [
                'label' => 'Payment Method',
                'placeholder' => 'Please select payment method',
                'items' => [
                    'cash' => 'Cash',
                    'bank' => 'Bank'
                ],
            ],
            'amount' => ['label' => 'Amount', 'placeholder' => 'Please insert amount'],
            'description' => ['label' => 'Description', 'placeholder' => 'Please write a detailed description'],
            'status' => [
                'label' => ' Status',
                'items' => [
                    'collected' => 'Collected',
                    'uncollected' => 'Uncollected',
                ],
            ],
        ],
        'flash' => [
            'created' => 'A new revenue has been created',
            'updated' => 'The revenue number :revenue has been updated',
            'deleted' => 'The revenue :revenue is deleted'
        ],
    ],
    'reports' => [
        'index' => [
            'header' => 'Reports',
            'table' => [
                '#' => '#',
                'from' => 'From',
                'to' => 'To',
                'type' => 'Type',
                'average' => 'Average',
                'total' => 'Total',
            ]
        ],
        'create' => ['header' => 'Create New Report'],
        'edit' => ['header' => 'Update Report Number :report'],
        'form' => [
            'from' => ['label' => 'From', 'placeholder' => 'Please insert the start date of the report'],
            'to' => ['label' => 'To', 'placeholder' => 'Please insert the end date of the report'],
            'type' => [
                'label' => 'Type',
                'placeholder' => 'Please select the type of the report',
                'items' => ['expenses' => 'Expenses', 'revenues' => 'Revenues', 'all' => 'All']
            ],
        ],
        'flash' => [
            'created' => 'A new report has been created',
            'updated' => 'The report number :report has been updated',
            'deleted' => 'The report :report is deleted'
        ],
    ],
    'advertisements' => [
        'index' => [
            'header' => 'Advertisements',
            'table' => [
                'name' => 'Name',
                'start_date' => 'Start Date',
                'end_date' => 'End Date',
                'price' => 'Price',
                'status' => 'Status',
                'owner_name' => 'Owner Name',
            ]
        ],
        'create' => ['header' => 'Create New Advertisement'],
        'edit' => ['header' => 'Update The Advertisement :advertisement'],
        'form' => [
            'name' => ['label' => 'Name', 'placeholder' => 'Please write the name of advertisement'],
            'start_date' => ['label' => 'Start Date', 'placeholder' => 'Please insert the start date of the advertisement'],
            'start_date' => ['label' => 'End Date', 'placeholder' => 'Please insert the end date of the advertisement'],
            'price' => ['label' => 'Price', 'placeholder' => 'Please write the advertisement price'],
            'status' => ['label' => 'Status', 'placeholder' => 'Please write the status of the advertisement'],
            'owner_name' => ['label' => 'Owner Name', 'placeholder' => 'Please write the owner\'s name'],
            'owner_name' => ['label' => 'Owner Phone', 'placeholder' => 'Please write the owner\'s phone'],
        ],
        'flash' => [
            'created' => 'A new advertisement has been created',
            'updated' => 'The advertisement :advertisement has been updated',
            'deleted' => 'The advertisement :advertisement is deleted'
        ],
    ],
    'suppliers' => [
        'index' => [
            'header' => 'Suppliers',
            'table' => [
                'name' => 'Name',
                'email' => 'Email',
                'phone' => 'Phone',
                'address' => 'Address',
                'businessField' => 'Business Field',
            ]
        ],
        'create' => ['header' => 'Create New Supplier'],
        'edit' => ['header' => 'Update The supplier :supplier'],
        'form' => [
            'name' => ['label' => 'Name', 'placeholder' => 'Please enter the supplier\'s name'],
            'email' => ['label' => 'Email', 'placeholder' => 'Please enter the supplier\'s email'],
            'phone' => ['label' => 'Phone', 'placeholder' => 'Please enter the supplier\'s phone'],
            'address' => ['label' => 'Address', 'placeholder' => 'Please enter the supplier\'s address'],
            'businessField' => ['label' => 'Business Field', 'placeholder' => 'Please selet the supplier\'s business field'],
        ],
        'flash' => [
            'created' => 'A new supplier has been created',
            'updated' => 'The supplier :supplier has been updated',
            'deleted' => 'The supplier :supplier has been deleted'
        ],
    ],
    'services' => [
        'index' => [
            'header' => 'Services',
            'table' => [
                '#' => '#',
                'description' => 'Description',
                'price' => 'Price',
            ]
        ],
        'create' => ['header' => 'Create New service'],
        'edit' => ['header' => 'Update The service :service'],
        'form' => [
            'description' => ['label' => 'Description', 'placeholder' => 'Please enter the service description'],
            'price' => ['label' => 'Price', 'placeholder' => 'Please enter the service price'],
        ],
        'flash' => [
            'created' => 'A new service has been created',
            'updated' => 'The service :service has been updated',
            'deleted' => 'The service :service has been deleted'
        ],
    ],
    'profile' => [
        'back' => 'Back',
        'edit' => 'Edit Profile',
        'name' => 'Name',
        'email' => 'Email',
        'phone' => 'Phone',
        'password' => 'Password',
        'confirm_password' => 'Confirm Password',
        'photo' => 'Change Photo',
        'update' => 'Update'
    ]
];
