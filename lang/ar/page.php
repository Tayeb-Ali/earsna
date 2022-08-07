<?php

return [
    'dashboard' => [
        'header' => 'لوحة التحكم',
        'cards' => [
            'revenues' => [
                'all' => 'جميع الإيرادات', 'collected' => 'الإيرادات المحصلة', 'uncollected' => 'الإيرادات غير المحصلة',
            ],
            'expenses' => 'المصروفات',
            'bookings' => [
                'all' => 'جميع الحجوزات',
                'confirmed' => 'الحجوزات المؤكدة',
                'temporary' => 'الحجوزات المؤقتة',
                'canceled' => 'الحجوزات الملغية',
                'paid' => 'الحجوزات المدفوعة'
            ]
        ],
        'charts' => [
            'bar' => [
                'label' => 'عدد الحجوزات في آخر 5 أشهر'
            ]
        ],
        'boxes' => [
            'revenues' => [
                'all' => 'جميع الإيرادات',
                'collected' => 'الإيرادات المستلمة',
                'uncollected' => 'الإيرادات المستحقة'
            ],
            'expenses' => [
                'all' => 'جميع المصروفات'
            ]
        ]
    ],
    'settings' => [
        'header' => 'الإعدادات',
        'greeting' => 'مرحباً، الرجاء اختيار واحدة من الإعدادات التي على اليمين.'
    ],
    'users' => [
        'index' => [
            'header'=> 'المستخدمون',
            'table' => ['name' => 'الاسم', 'email' => 'البريد الإلكتروني', 'phone' => 'الهاتف', 'role' => 'الدور'],
        ],
        'create'=> ['header' => 'إنشاء مستخدم جديد'],
        'edit' => ['header' => 'تحديث بيانات المستخدم :user'],
        'form' => [
            'name' => ['label' => 'الإسم الكامل', 'placeholder' => 'الرجاء إدخال اسم المستخدم الكامل'],
            'email' => ['label' => 'الإيميل', 'placeholder' => 'user@example.com'],
            'phone' => ['label' => 'الهاتف', 'placeholder' => 'الرجاء كتابة رقم الجوال متضمناً مفتاح البلد'],
            'role' => [
                'label' => 'الدور',
                'placeholder' => 'الرجاء اختيار واحد من الأدوار التالية',
                'items' => ['admin' => 'مدير', 'accountant' => 'محاسب', 'data_entry' => 'مدخل بيانات']
            ],
        ],
        'flash' => [
            'created' => 'تم إنشاء مستخدم جديد',
            'updated' => 'تم تحديث بيانات المستخدم :user',
            'deleted' => 'تم حذف المستخدم :user'
        ],
    ],
    'features' => [
        'index' => ['header' => 'الميزات', 'table' => ['description' => 'الوصف']],
        'create' => ['header' => 'إنشاء ميزة جديدة'],
        'edit' => ['header' => 'تحديث الميزة :feature', ],
        'form' => ['description' => ['label' => 'الوصف', 'placeholder' => 'اكتب شرحا مبسطا لهذه الميزة']],
        'flash' => [
            'created' => 'تم إنشاء ميزة جديدة ',
            'updated' => 'تم تحديث بيانات الميزة :feature',
            'deleted' => 'تم حذف الميزة :feature'
        ]
    ],
    'offers' => [
        'index' => ['header' => 'الباقات', 'table' => ['#' => '#', 'description' => 'الوصف', 'price' => 'السعر']],
        'create' => ['header' => 'إنشاء باقة جديد'],
        'edit' => ['header' => 'تحديث الباقة :offer'],
        'form' => [
            'description' => ['label' => 'الوصف', 'placeholder' => 'اكتب شرحا مبسطا لهذه الباقة'],
            'price' => ['label' => 'السعر', 'placeholder' => 'الرجاء إدخال سعر الباقة']
        ],
        'flash' => [
            'created' => 'تم إنشاء باقة جديدة',
            'updated' => 'تم تحديث بيانات الباقة :offer',
            'deleted' => 'تم حذف الباقة :offer'
        ]
    ],
    'packages' => [
        'index' => ['header' => 'الباقات'],
        'create' => [ 'header' => 'إنشاء باقة جديدة', ],
        'edit' => ['header' => 'تحديث الباقة :package', ],
        'form' => [
            'name' => ['label' => 'الإسم', 'placeholder' => 'اكتب إسم الباقة هنا.'],
            'features' => ['label' => 'الميزات'],
            'price' => [
                'label' => 'السعر',
                'placeholder' => 'اكتب سعر الباقة هنا.',
                'note' => 'إذا لم يدخل رقم في حقل السعر فسيتم إدخال سعر الباكج صفر تلقائياً'
            ],
        ],
        'flash' => [
            'created' => 'تم إنشاء باقة جديدة ',
            'updated' => 'تم تحديث بيانات الباقة :package',
            'deleted' => 'تم حذف الباقة :package'
        ]
    ],
    'clients' => [
        'index' => [
            'header' => 'العملاء',
            'table' => [
                'name' => 'الاسم',
                'email' => 'البريد الإلكتروني',
                'phone' => 'الهاتف',
                'domain' => 'رابط الموقع',
                'address' => 'عنوان مقر العمل',
                'businessField' => 'مجال العمل'
            ],
        ],
        'create' => ['header' => 'إنشاء عميل جديد'],
        'edit' => ['header' => 'تحديث بيانات العميل :client'],
        'form' => [
            'name' => ['label' => 'الإسم الكامل', 'placeholder' => 'الرجاء إدخال اسم العميل الكامل'],
            'phone' => ['label' => 'الهاتف', 'placeholder' => 'الرجاء كتابة رقم الجوال متضمناً مفتاح البلد'],
            'email' => ['label' => 'البريد الإلكتروني', 'placeholder' => 'client@example.com'],
            'address' => ['label' => 'عنوان مقر العمل', 'placeholder' => 'الرجاء كتابة عنوان مقر العمل'],
            'businessField' => ['label' => 'مجال العمل'],
            'domain' => ['label' => 'رابط الموقع', 'placeholder' => 'ersana.com'],
        ],
        'flash' => [
            'created' => 'تم إنشاء عميل جديد',
            'updated' => 'تم تحديث بيانات العميل :client',
            'deleted' => 'تم حذف العميل :client'
        ],
    ],
    'subscriptions' => [
        'index' => [
            'header' => 'الإشتراكات',
            'table' => ['#' => '#', 'package' => 'الباقة', 'client' => 'العميل', 'status' => 'الحالة'],
        ],
        'create' => ['header' => 'إنشاء إشتراك جديد'],
        'edit' => ['header' => 'تحديث بيانات الإشتراك :subscription', 'note' => ''],
        'form' => [
            'client' => ['label' => 'العميل', 'placeholder' => 'الرجاء اختيار واحد من العملاء الموجودين.'],
            'package' => ['label' => 'الباقة', 'placeholder' => 'الرجاء اختيار واحدة من الباقات الموجودة.'],
            'hall' => [
                'name' => ['label' => 'إسم القاعة', 'placeholder' => 'الرجاء كتابة إسم القاعة'],
                'city' => ['label' => 'المدينة المتواجدة بها القاعة', 'placeholder' => 'الرجاء اختيار المدينة الموجودة بها القاعة'],
                'address' => ['label' => 'عنوان القاعة', 'placeholder' => 'الرجاء كتابة عنوان القاعة'],
                'button' => 'إضافة قاعات العميل'
            ],
            'note' => ['label' => 'ملاحظة', 'content' => 'لتعديل بيانات قاعات العميل الرجاء التوجه إلى قسم القاعات ثم اختيار القاعات الخاصة بالعميل المحدد']
        ],
        'flash' => [
            'created' => 'تم إنشاء إشتراك جديد',
            'updated' => 'تم تحديث بيانات الإشتراك رقم :subscription',
            'deleted' => 'تم حذف الإشتراك رقم :subscription'
        ],
    ],
    'businessFields' => [
        'index' => ['header' => 'مجالات العمل', 'table' => ['field' => 'المجال']],
        'create' => [ 'header' => 'إنشاء مجال عمل جديد', ],
        'edit' => ['header' => 'تحديث بيانات مجال العمل :field'],
        'form' => [
            'name' => ['label' => 'الإسم', 'placeholder' => 'الأعراس و المناسبات'],
        ],
        'flash' => [
            'created' => 'تم إنشاء مجال عمل جديد',
            'updated' => 'تم تحديث بيانات مجال العمل :field',
            'deleted' => 'تم حذف مجال العمل :field'
        ],
        'types' => ['advertisement' => 'إعلان', 'booking' => 'حجز']
    ],
    'halls' => [
        'index' => [
            'header' => 'القاعات',
            'table' => [
                '#' => '#',
                'name' => 'الإسم',
                'city' => 'المدينة',
                'address' => 'العنوان',
                'capacity' => 'السعة',
                'client' => 'العميل',
                'period' => 'الفترة',
                'from' => 'من',
                'to' => 'إلى',
                'price' => 'السعر'
            ]
        ],
        'create' => ['header' => 'إنشاء قاعة جديدة'],
        'edit' => ['header' => 'تحديث بيانات القاعة :hall'],
        'form' => [
            'name' => ['label' => 'إسم القاعة', 'placeholder' => 'الرجاء إدخال إسم القاعة'],
            'city' => ['label' => 'المدينة', 'placeholder' => 'الرجاء اختيار المدينة المتواجدة بها القاعة'],
            'address' => ['label' => 'العنوان', 'placeholder' => 'الرجاء كتابة عنوان القاعة'],
            'capacity' => ['label' => 'السعة', 'placeholder' => 'عدد الأشخاص الذين تسعهم القاعة', 'person' => 'شخص'],
        ],
        'flash' => [
            'created' => 'تم إنشاء قاعة جديدة',
            'updated' => 'تم تحديث بيانات القاعة :hall',
            'deleted' => 'تم حذف القاعة :hall'
        ],
    ],
    'bookingTimes' => [
        'index' => [
            'header' => 'أوقات الحجوزات',
            'table' => ['#' => '#', 'period' => 'الفترة', 'from' => 'من', 'to' => 'إلى', 'price' => 'السعر']
        ],
        'create' => ['header' => 'إنشاء وقت حجز جديد'],
        'edit' => ['header' => 'تحديث بيانات وقت الحجز :bookingTime'],
        'form' => [
            'period' => ['label' => 'الفترة', 'items' => ['day' => 'صباحاً', 'evening' => 'مساءاً']],
            'from' => ['label' => 'من', 'placeholder' => 'الرجاء تحديد وقت'],
            'to' => ['label' => 'إلى', 'placeholder' => 'الرجاء تحديد وقت'],
            'price' => ['label' => 'السعر', 'placeholder' => 'الرجاء تحديد سعر وقت الحجز']
        ],
        'flash' => [
            'created' => 'تم إنشاء وقت حجز جديد',
            'updated' => 'تم تحديث بيانات وقت الحجز :bookingTime',
            'deleted' => 'تم حذف الوقت :bookingTime',
            'unavailable' => 'عذراً، جميع المواعيد محجوزة في هذه الفترة من هذا التاريخ'
        ],
    ],
    'customers' => [
        'index' => [
            'header' => 'أصحاب الحجوزات',
            'table' => [
                'name' => 'الاسم',
                'company' => 'الشركة',
                'email' => 'البريد الإلكتروني',
                'phone' => 'الهاتف',
                'address' => 'العنوان',
            ]
        ],
        'create' => ['header' => 'إنشاء صاحب حجز جديد'],
        'edit' => ['header' => 'تحديث بيانات صاحب الحجز :customer'],
        'form' => [
            'name' => ['label' => 'إسم صاحب الحجز', 'placeholder' => 'الإسم الكامل لمن قام بالحجز'],
            'company' => ['label' => 'الشركة', 'placeholder' => 'الرجاء كتابة إسم الشركة التابعة من قام بالحجز إن وجدت'],
            'email' => ['label' => 'البريد الإلكتروني', 'placeholder' => 'customer@example.com'],
            'phone' => ['label' => 'الهاتف', 'placeholder' => 'الرجاء كتابة رقم هاتف صاحب الحجز'],
            'address' => ['label' => 'العنوان', 'placeholder' => 'الرجاء كتابة عنوان صاحب الحجز',],
        ],
        'flash' => [
            'created' => 'تم إنشاء صاحب حجز جديد',
            'updated' => 'تم تحديث بيانات صاحب الحجز :customer',
            'deleted' => 'تم حذف صاحب الحجز :customer'
        ],
    ],
    'bookings' => [
        'index' => [
            'header' => 'الحجوزات',
            'table' => [
                '#' => '#',
                'customer' => 'الإسم',
                'date' => 'تاريخ الحجز',
                'period' => 'الفترة',
                'from' => 'من',
                'to' => 'إلى',
                'total' => 'سعر الحجز',
                'status' => 'حالة الحجز'
            ]
        ],
        'create' => [
            'header' => 'إنشاء حجز جديد',
            'customer_information' => 'بيانات صاحب الحجز',
            'booking_times' => 'أوقات الحجوزات',
            'offers' => 'الباقات و الخدمات',
            'payment' => 'الدفع',
            'additional_information' => 'معلومات إضافية'
        ],
        'show' => ['header' => 'الحجز رقم :booking'],
        'edit' => ['header' => 'تحديث بيانات الحجز رقم :booking'],
        'form' => [
            'customer' => [
                'name' => ['label' => 'الإسم', 'placeholder' => 'الرجاء إدخال إسم صاحب الحجز'],
                'company' => ['label' => 'Company', 'placeholder' => 'Please write the customer\'s company name'],
                'email' => ['label' => 'البريد الإلكتروني', 'placeholder' => 'الرجاء كتابة البريد الإلكتروني لصاحب الحجز'],
                'phone' => ['label' => 'الهاتف', 'placeholder' => 'الرجاء كتابة هاتف صاحب الحجز'],
                'address' => ['label' => 'العنوان', 'placeholder' => 'الرجاء كتابة عنوان صاحب الحجز',],
                'placeholder' => 'الرجاء اختيار واحد من العملاء الذين في القائمة'
            ],
            'date' => ['label' => 'تاريخ الحجز', 'placeholder' => 'الرجاء اختيار تاريخ'],
            'bookingTimes' => ['label' => 'أوقات الحجز المتوفرة', 'button' => 'بحث'],
            'payment_method' => [
                'label' => 'طريقة الدفع',
                'placeholder' => 'الرجاء اختيار طريقة',
                'items' => ['bank' => 'حوالة بنكية', 'cash' => 'نقداً']
            ],
            'paid' => ['label' => 'المبلغ المدفوع', 'placeholder' => 'الرجاء إدخال المبلغ الذي يراد دفعه'],
            'remaining' => ['label' => 'المبلغ المتبقي', 'placeholder' => ''],
            'total' => ['label' => 'الإجمالي'],
            'status' => [
                'label' => ' الحالة',
                'items' => [
                    'confirmed' => 'مؤكد',
                    'temporary' => 'مؤقت',
                    'paid' => 'مدفوع',
                    'canceled' => 'ملغي',
                ],
            ],
            'notes' => ['label' => 'ملاحظات', 'placeholder' => 'الرجاء كتابة أي ملاحظات إضافية']
        ],
        'flash' => [
            'created' => 'تم إنشاء حجز جديد',
            'updated' => 'تم تحديث بيانات الحجز رقم :booking',
            'deleted' => 'تم حذف الحجز رقم :booking'
        ],
    ],
    'expenses' => [
        'index' => [
            'header' => 'المصروفات',
            'table' => [
                '#' => '#',
                'date' => 'التاريخ',
                'payment_method' => 'طريقة الدفع',
                'amount' => 'المبلغ',
                'description' => 'الوصف',
            ]
        ],
        'create' => ['header' => 'إنشاء مصروف جديد'],
        'edit' => ['header' => 'تحديث بيانات المصروف رقم :expense'],
        'form' => [
            'date' => ['label' => 'التاريخ', 'placeholder' => 'الرجاء ادخال تاريخ'],
            'payment_method' => [
                'label' => 'طريقة الدفع',
                'placeholder' => 'الرجاء اختيار طريقة الدفع',
                'items' => ['cash' => 'نقداً', 'bank' => 'بنك']
            ],
            'amount' => ['label' => 'المبلغ', 'placeholder' => 'الرجاء كتابة البلغ'],
            'description' => ['label' => 'الوصف', 'placeholder' => 'الرجاء كتابة وصف المصروف بالتفصيل']
        ],
        'flash' => [
            'created' => 'تم إنشاء مصروف جديد',
            'updated' => 'تم تحديث بيانات المصروف رقم :expense',
            'deleted' => 'تم حذف المصروف رقم :expense'
        ],
    ],
    'revenues' => [
        'index' => [
            'header' => 'الإيرادات',
            'table' => [
                '#' => '#',
                'date' => 'التاريخ',
                'payment_method' => 'طريقة الدفع',
                'amount' => 'المبلغ',
                'description' => 'الوصف',
            ]
        ],
        'create' => ['header' => 'إنشاء إيراد جديد'],
        'edit' => ['header' => 'تحديث بيانات الإيراد رقم :revenue'],
        'form' => [
            'date' => ['label' => 'التاريخ', 'placeholder' => 'الرجاء ادخال تاريخ'],
            'payment_method' => [
                'label' => 'طريقة الدفع',
                'placeholder' => 'الرجاء اختيار طريقة الدفع',
                'items' => ['cash' => 'نقداً', 'bank' => 'بنك']
            ],
            'amount' => ['label' => 'المبلغ', 'placeholder' => 'الرجاء كتابة البلغ'],
            'description' => ['label' => 'الوصف', 'placeholder' => 'الرجاء كتابة وصف المصروف بالتفصيل'],
            'status' => [
                'label' => ' الحالة',
                'items' => [
                    'collected' => 'مستلمة',
                    'uncollected' => 'مستحقة',
                ],
            ],
        ],
        'flash' => [
            'created' => 'تم إنشاء إيراد جديد',
            'updated' => 'تم تحديث بيانات الإيراد رقم :revenue',
            'deleted' => 'تم حذف الإيراد رقم :revenue'
        ],
    ],
    'reports' => [
        'index' => [
            'header' => 'التقارير',
            'table' => [
                '#' => '#',
                'from' => 'من',
                'to' => 'إلى',
                'type' => 'النوع',
                'average' => 'المتوسط',
                'total' => 'الإجمالي',
            ]
        ],
        'create' => ['header' => 'إنشاء تقرير جديد'],
        'edit' => ['header' => 'تحديث بيانات التقرير رقم :report'],
        'show' => ['header' => 'تقرير رقم :report'],
        'form' => [
            'from' => ['label' => 'من', 'placeholder' => 'الرجاء ادخال تاريخ ابتداء التقرير'],
            'to' => ['label' => 'إلى', 'placeholder' => 'الرجاء ادخال تاريخ انتهاء التقرير'],
            'type' => [
                'label' => 'النوع',
                'placeholder' => 'الرجاء ادخال نوع التقرير',
                'items' => ['expenses' => 'المصروفات', 'revenues' => 'الإيرادات', 'all' => 'الكل'],
            ],
        ],
        'flash' => [
            'created' => 'تم إنشاء تقرير جديد',
            'updated' => 'تم تحديث بيانات التقرير رقم :report',
            'deleted' => 'تم حذف التقرير رقم :report'
        ],
    ],
    'advertisements' => [
        'index' => [
            'header' => 'الإعلانات',
            'table' => [
                'name' => 'الإسم',
                'start_date' => 'تاريخ بداية الإعلان',
                'end_date' => 'تاريخ نهاية الإعلان',
                'price' => 'السعر',
                'status' => 'الحالة',
                'owner_name' => 'المالك',
            ]
        ],
        'create' => ['header' => 'إنشاء إعلان جديد'],
        'edit' => ['header' => 'تحديث بيانات الإعلان :advertisement'],
        'form' => [
            'name' => ['label' => 'الإسم', 'placeholder' => 'الرجاء كتابة إسم الإعلان'],
            'start_date' => ['label' => 'تاريخ البداية', 'placeholder' => 'الرجاء إدخال تاريخ بداية الإعلان'],
            'end_date' => ['label' => 'تاريخ الإنتهاء', 'placeholder' => 'الرجاء إدخال تاريخ إنتهاء الإعلان'],
            'price' => ['label' => 'السعر', 'placeholder' => 'الرجاء كتابة سعر الإعلان'],
            'status' => ['label' => 'الحالة', 'placeholder' => 'الرجاء إدخال حالة الإعلان'],
            'owner_name' => ['label' => 'إسم صاحب الإعلان', 'placeholder' => 'الرجاء كتابة إسم صاحب الإعلان'],
            'owner_phone' => ['label' => 'هاتف صاحب الإعلان', 'placeholder' => 'الرجاء كتابة هاتف صاحب الإعلان'],
        ],
        'flash' => [
            'created' => 'تم إنشاء إعلان جديد',
            'updated' => 'تم تحديث بيانات الإعلان :advertisement',
            'deleted' => 'تم حذف الإعلان :advertisement'
        ],
    ],
    'suppliers' => [
        'index' => [
            'header' => 'الموردون',
            'table' => [
                'name' => 'الإسم',
                'email' => 'البريد الإلكتروني',
                'phone' => 'الهاتف',
                'address' => 'العنوان',
                'businessField' => 'مجال العمل',
            ]
        ],
        'create' => ['header' => 'إنشاء مورد جديد'],
        'edit' => ['header' => 'تحديث بيانات المورد :supplier'],
        'form' => [
            'name' => ['label' => 'الإسم', 'placeholder' => 'الرجاء كتابة إسم المورد'],
            'email' => ['label' => 'البريد الإلكتروني', 'placeholder' => 'الرجاء إدخال البريد الإلكتروني'],
            'phone' => ['label' => 'الهاتف', 'placeholder' => 'الرجاء إدخال الهاتف'],
            'address' => ['label' => 'العنوان', 'placeholder' => 'الرجاء إدخال العنوان'],
            'businessField' => ['label' => 'مجال العمل', 'placeholder' => 'الرجاء اختيار مجال عمل'],
        ],
        'flash' => [
            'created' => 'تم إنشاء مورد جديد',
            'updated' => 'تم تحديث بيانات المورد :supplier',
            'deleted' => 'تم حذف المورد :supplier'
        ],
    ],
    'services' => [
        'index' => [
            'header' => 'الخدمات',
            'table' => [
                '#' => '#',
                'description' => 'الوصف',
                'price' => 'السعر',
            ]
        ],
        'create' => ['header' => 'إنشاء خدمة جديد'],
        'edit' => ['header' => 'تحديث بيانات الخدمة :service'],
        'form' => [
            'description' => ['label' => 'الوصف', 'placeholder' => 'الرجاء إدخال وصف واضح للخدمة'],
            'price' => ['label' => 'السعر', 'placeholder' => 'الرجاء إدخال سعر الخدمة'],
        ],
        'flash' => [
            'created' => 'تم إنشاء خدمة جديد',
            'updated' => 'تم تحديث بيانات الخدمة :service',
            'deleted' => 'تم حذف الخدمة :service'
        ],
    ],
    'profile' => [
        'back' => 'العودة',
        'edit' => 'تعديل البيانات',
        'name' => 'الإسم',
        'email' => 'البريد الإلكتروني',
        'phone' => 'الهاتف',
        'password' => 'كلمة المرور',
        'confirm_password' => 'تأكيد كلمة المرور',
        'photo' => 'تغيير الصورة',
        'update' => 'تحديث'
    ]
];
