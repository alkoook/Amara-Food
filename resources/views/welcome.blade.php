<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>هيكل لوحة تحكم AmaraFood - ثيم زجاجي حيوي</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <style>
        /* التخصيص العام: خلفية حية وداكنة */
        body {
            font-family: 'Cairo', sans-serif;
            background: #0f0a28; /* Indigo 950 تقريباً */
            background-image: linear-gradient(135deg, #0f0a28 0%, #1c0e3e 50%, #0f0a28 100%);
            color: #d1d5db; /* gray-300 */
        }
        /* سطوح البطاقات: خلفية شبه شفافة مع ضبابية (Glass Effect) */
        .surface-card {
            background-color: rgba(255, 255, 255, 0.05); /* 5% white transparency */
            backdrop-filter: blur(8px); /* Blur effect */
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        /* تصميم الشريط الجانبي (Sidebar) - زجاجي عصري */
        .sidebar {
            background-color: rgba(255, 255, 255, 0.04); /* 4% white transparency */
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 1.5rem;
            min-height: calc(100vh - 120px);
            padding: 1.5rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            position: relative; /* لتمكين التموضع المطلق للخلفية المتدرجة */
            overflow: hidden;
        }

        /* عناصر القائمة الجانبية (Nav Items) */
        .nav-item {
            /* تصميم الزر العادي */
            @apply w-full text-right px-4 py-3 rounded-xl transition-all duration-300 flex items-center font-medium text-lg text-gray-300 hover:bg-white/10 relative overflow-hidden z-10;
        }
        /* العنصر النشط - تأثير متدرج وبارز */
        .nav-item.active-vibrant {
            @apply text-white font-extrabold shadow-xl shadow-cyan-500/10;
            background: linear-gradient(to right, rgba(6, 182, 212, 0.2) 0%, rgba(139, 92, 246, 0.2) 100%); /* Blue/Violet Transparent */
            border-right: 4px solid #38bdf8; /* Sky-400 */
        }
        .nav-item.active-vibrant .nav-icon {
            @apply text-sky-400;
        }

        /* زر الإجراء الرئيسي بلون حاد */
        .main-action-btn {
            @apply px-6 py-3 font-bold text-white bg-gradient-to-r from-sky-500 to-indigo-600 hover:from-sky-400 hover:to-indigo-500 rounded-xl transition-all shadow-lg shadow-sky-500/40;
        }
    </style>
</head>
<body class="min-h-screen">

    <!-- @section('header') -->
    <header class="surface-card sticky top-0 z-50 border-b-4 border-sky-400/70">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <div class="flex items-center">
                 <!-- شعار بارز بألوان حيوية -->
                <i class="fas fa-rocket text-4xl text-sky-400 ml-3 animate-pulse"></i>
                <h1 class="text-3xl font-extrabold text-white tracking-wider">
                    AmaraFood <span class="text-gray-400 font-medium">| لوحة الإدارة</span>
                </h1>
            </div>
            <!-- معلومات المدير -->
            <div class="text-sm text-gray-400 p-2 bg-white/10 rounded-full pr-4 pl-3 border border-white/20">
                <i class="fas fa-user-astronaut ml-2 text-sky-400"></i>
                مرحباً أيها المطور،
                <span class="font-extrabold text-white">
                    أحمد بيك
                </span>
            </div>
        </div>
    </header>
    <!-- @show -->

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 grid grid-cols-1 lg:grid-cols-12 gap-10">

        <!-- الشريط الجانبي (Sidebar Navigation) - التصميم الزجاجي الحيوي -->
        <aside class="lg:col-span-3 sidebar h-full lg:sticky lg:top-28">
            <h3 class="text-xs uppercase tracking-widest text-gray-400 mb-6 px-2 border-b border-white/10 pb-3">
                <i class="fas fa-cube ml-2 text-sky-400"></i> مكونات النظام
            </h3>
            <nav class="space-y-3">
                <!-- العنصر النشط - active-vibrant -->
                <a href="/admin/products" class="nav-item active-vibrant">
                    <i class="fas fa-microchip ml-4 text-2xl nav-icon"></i>
                    إدارة الوحدات (Modules)
                </a>
                <a href="/admin/categories" class="nav-item">
                    <i class="fas fa-code ml-4 text-2xl"></i>
                    مشاريع Laravel
                </a>
                <a href="/admin/brands" class="nav-item">
                    <i class="fas fa-database ml-4 text-2xl"></i>
                    إدارة قواعد البيانات
                </a>
                <a href="/admin/users" class="nav-item">
                    <i class="fas fa-server ml-4 text-2xl"></i>
                    الـ APIs والخوادم
                </a>
            </nav>

            <div class="mt-8 pt-6 border-t border-white/10">
                <h3 class="text-xs uppercase tracking-widest text-gray-400 mb-6 px-2 pb-3">
                    <i class="fas fa-bolt ml-2 text-sky-400"></i> الأداء والمهام
                </h3>
                <a href="/admin/settings" class="nav-item">
                    <i class="fas fa-tachometer-alt ml-4 text-2xl"></i>
                    مراقب الأداء (Monitoring)
                </a>
                <a href="/logout" class="nav-item mt-3 bg-red-900/40 hover:bg-red-800/60 text-red-300 hover:text-white">
                    <i class="fas fa-plug ml-4 text-xl"></i>
                    قطع الاتصال (Sign Out)
                </a>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="lg:col-span-9">
            <div class="surface-card p-8 rounded-2xl min-h-[70vh]">

                <!-- محاكاة محتوى (API Endpoints) -->
                <div class="space-y-8">
                    <div class="flex justify-between items-center pb-4 border-b border-white/20">
                        <h2 class="text-3xl font-extrabold text-white">وحدات الـ BackEnd</h2>
                        <!-- زر الإضافة بلون حاد وجذاب -->
                        <a href="#" class="main-action-btn">
                            <i class="fas fa-plus ml-2"></i> إنشاء وحدة جديدة
                        </a>
                    </div>

                    <!-- بطاقات إحصائيات سريعة - حركة ونبض -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- بطاقة 1: المنتجات -->
                        <div class="surface-card p-6 rounded-xl space-y-3 hover:shadow-sky-500/20">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-semibold text-gray-400 uppercase">مشاريع Laravel</span>
                                <i class="fas fa-cubes text-3xl text-sky-500/70"></i>
                            </div>
                            <p class="text-4xl font-extrabold text-white">12</p>
                            <p class="text-xs text-gray-500 flex items-center">
                                <i class="fas fa-arrow-up ml-1 text-green-400"></i>
                                3 مشاريع جديدة هذا الأسبوع
                            </p>
                        </div>
                        <!-- بطاقة 2: المستخدمين -->
                        <div class="surface-card p-6 rounded-xl space-y-3 hover:shadow-indigo-500/20">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-semibold text-gray-400 uppercase">مستخدمو الـ API</span>
                                <i class="fas fa-user-shield text-3xl text-indigo-500/70"></i>
                            </div>
                            <p class="text-4xl font-extrabold text-white">4,890</p>
                            <p class="text-xs text-gray-500 flex items-center">
                                <i class="fas fa-arrow-down ml-1 text-red-400"></i>
                                تراجع في نشاط الـ Tokens بنسبة 2%
                            </p>
                        </div>
                        <!-- بطاقة 3: الأداء -->
                        <div class="surface-card p-6 rounded-xl space-y-3 hover:shadow-fuchsia-500/20">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-semibold text-gray-400 uppercase">متوسط وقت الاستجابة</span>
                                <i class="fas fa-clock text-3xl text-fuchsia-500/70 animate-pulse"></i>
                            </div>
                            <p class="text-4xl font-extrabold text-white">145<span class="text-xl font-medium text-gray-400 mr-1">ms</span></p>
                            <p class="text-xs text-gray-500 flex items-center">
                                <i class="fas fa-exclamation-triangle ml-1 text-yellow-400"></i>
                                تحتاج تحسين في Route `/v1/orders`
                            </p>
                        </div>
                    </div>
                    <!-- نهاية بطاقات الإحصائيات -->

                    <!-- جدول عرض الوحدات (Modules/Routes) -->
                    <div class="surface-card p-6 rounded-xl overflow-x-auto">
                        <h3 class="text-xl font-bold text-white mb-4">قائمة الـ Endpoints الرئيسية</h3>
                        <table class="min-w-full divide-y divide-white/10">
                            <thead class="bg-white/5">
                                <tr>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-300 uppercase tracking-wider">الـ Endpoint</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-300 uppercase tracking-wider">الطريقة</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-300 uppercase tracking-wider">الحالة</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-300 uppercase tracking-wider">المحمي بـ</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-300 uppercase tracking-wider">إجراءات</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/10">
                                <tr class="hover:bg-white/5 transition duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white">/api/v1/products</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="bg-green-600/20 text-green-400 px-3 py-1 rounded-full font-bold text-xs">GET</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="text-green-400 font-bold"><i class="fas fa-check-circle ml-1"></i> يعمل</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">Sanctum Token</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2 space-x-reverse">
                                        <button class="text-sm py-1 px-2 text-sky-400 hover:text-sky-300 font-bold transition"><i class="fas fa-cogs"></i> اختبار</button>
                                        <button class="text-sm py-1 px-2 text-red-400 hover:text-red-300 font-bold transition"><i class="fas fa-times-circle"></i> إيقاف</button>
                                    </td>
                                </tr>
                                <tr class="hover:bg-white/5 transition duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white">/api/v1/orders/create</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="bg-indigo-600/20 text-indigo-400 px-3 py-1 rounded-full font-bold text-xs">POST</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="text-yellow-400 font-bold"><i class="fas fa-exclamation-triangle ml-1"></i> بطيء</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">Passport OAuth</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2 space-x-reverse">
                                        <button class="text-sm py-1 px-2 text-sky-400 hover:text-sky-300 font-bold transition"><i class="fas fa-cogs"></i> اختبار</button>
                                        <button class="text-sm py-1 px-2 text-red-400 hover:text-red-300 font-bold transition"><i class="fas fa-times-circle"></i> إيقاف</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </main>
    </div>
</body>
</html>
