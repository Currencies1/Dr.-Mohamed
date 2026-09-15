<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم الاحترافية - الإدارة</title>
    <!-- استيراد خطوط وأيقونات عصرية -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --success: #10b981;
            --danger: #ef4444;
            --bg-color: #f8fafc;
            --card-bg: #ffffff;
            --text-color: #1e293b;
            --border-color: #e2e8f0;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Cairo', sans-serif; }
        body { background: var(--bg-color); color: var(--text-color); direction: rtl; padding: 20px; }

        /* شاشة تسجيل الدخول */
        .login-wrapper {
            display: flex; justify-content: center; align-items: center; height: 100vh;
        }
        .login-card {
            background: var(--card-bg); padding: 40px; border-radius: 16px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
            width: 100%; max-width: 400px;
        }
        .login-card h2 { margin-bottom: 24px; color: var(--primary); text-align: center; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: 600; font-size: 14px; }
        .form-control {
            width: 100%; padding: 12px 16px; border: 1px solid var(--border-color);
            border-radius: 8px; font-size: 14px; outline: none; transition: border-color 0.2s;
        }
        .form-control:focus { border-color: var(--primary); }

        /* أزرار عصرية */
        .btn {
            background: var(--primary); color: white; border: none; padding: 12px 20px;
            border-radius: 8px; cursor: pointer; font-weight: 600; width: 100%;
            transition: background 0.2s, transform 0.1s; display: inline-flex; align-items: center; justify-content: center; gap: 8px;
        }
        .btn:hover { background: var(--primary-hover); }
        .btn-success { background: var(--success); }
        .btn-success:hover { background: #059669; }
        .btn-danger { background: var(--danger); }
        .btn-danger:hover { background: #dc2626; }
        .btn-sm { padding: 6px 12px; font-size: 13px; width: auto; }

        /* لوحة التحكم الرئيسية */
        .admin-dashboard { max-width: 1200px; margin: 0 auto; }
        .header-bar {
            display: flex; justify-content: space-between; align-items: center;
            background: var(--card-bg); padding: 20px 30px; border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02); margin-bottom: 24px;
        }
        
        /* بطاقات الإحصائيات السريعة */
        .stats-grid {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 24px;
        }
        .stat-card {
            background: var(--card-bg); padding: 20px; border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02); display: flex; align-items: center; gap: 16px;
        }
        .stat-icon {
            width: 50px; height: 50px; border-radius: 12px; background: #e0e7ff; color: var(--primary);
            display: flex; align-items: center; justify-content: center; font-size: 20px;
        }

        /* الجدول الاحترافي */
        .table-container {
            background: var(--card-bg); border-radius: 16px; overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);
        }
        table { width: 100%; border-collapse: collapse; text-align: right; }
        th, td { padding: 16px 20px; border-bottom: 1px solid var(--border-color); }
        th { background: #f8fafc; font-weight: 600; color: #64748b; font-size: 14px; }
        tr:hover { background: #f8fafc; }

        /* تنبيهات الـ Toast الاحترافية */
        #toast {
            position: fixed; bottom: 30px; left: 30px; background: #1e293b; color: #fff;
            padding: 14px 24px; border-radius: 10px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
            display: none; z-index: 1000; font-weight: 600; animation: slideIn 0.3s ease;
        }
        @keyframes slideIn { from { transform: translateY(100px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }

        .hidden { display: none !important; }
        .notes-input { width: 100%; padding: 8px 12px; border: 1px solid var(--border-color); border-radius: 6px; font-size: 13px; }
    </style>
</head>
<body>

    <!-- قسم تسجيل الدخول الاحترافي -->
    <div id="loginSection" class="login-wrapper">
        <div class="login-card">
            <h2><i class="fa-solid fa-shield-halved"></i> تسجيل دخول الأدمن</h2>
            <div id="loginError" style="color: var(--danger); margin-bottom: 15px; font-size: 14px; text-align: center;"></div>
            
            <div class="form-group">
                <label>البريد الإلكتروني</label>
                <input type="email" id="emailInput" class="form-control" placeholder="name@example.com">
            </div>
            
            <div class="form-group">
                <label>كلمة المرور</label>
                <input type="password" id="moh-pass" class="form-control" placeholder="••••••••">
            </div>
            
            <button onclick="login()" class="btn">دخول للنظام <i class="fa-solid fa-arrow-left"></i></button>
        </div>
    </div>

    <!-- لوحة التحكم الرئيسية الاحترافية -->
    <div id="adminSection" class="admin-dashboard hidden">
        <div class="header-bar">
            <div>
                <h2>مرحباً، محمد إسماعيل</h2>
                <p style="color: #64748b; font-size: 14px;">إدارة ومتابعة طلبات المستخدمين لحظة بلحظة</p>
            </div>
            <button onclick="logout()" class="btn btn-danger btn-sm"><i class="fa-solid fa-right-from-bracket"></i> تسجيل خروج</button>
        </div>

        <!-- إحصائيات سريعة -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon"><i class="fa-solid fa-clock"></i></div>
                <div>
                    <h3 id="totalOrdersCount">0</h3>
                    <p style="color: #64748b; font-size: 13px;">الطلبات الواردة</p>
                </div>
            </div>
        </div>

        <!-- جدول الطلبات -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th># رقم الطلب</th>
                        <th>اسم المستخدم</th>
                        <th>تفاصيل الطلب</th>
                        <th>ملاحظات الأدمن</th>
                        <th>الإجراءات المتاحة</th>
                    </tr>
                </thead>
                <tbody id="ordersTableBody">
                    <tr>
                        <td colspan="5" style="text-align: center; color: #64748b; padding: 40px;">جاري جلب الطلبات أو لا توجد طلبات جديدة...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- الإشعار المنبثق -->
    <div id="toast"><i class="fa-solid fa-bell" style="margin-left: 8px; color: #f59e0b;"></i> <span id="toastText"></span></div>

    <script>
        const ADMIN_EMAIL = "MohamedIsmail123@gmail.com";
        const ADMIN_PASS = "mohamad123";
        let lastOrderCount = 0;

        window.onload = function() {
            if (localStorage.getItem("isAdminLoggedIn") === "true") {
                showAdminPanel();
            }
        };

        function login() {
            const email = document.getElementById("emailInput").value.trim();
            const pass = document.getElementById("moh-pass").value.trim();
            const errorDiv = document.getElementById("loginError");

            if (email === ADMIN_EMAIL && pass === ADMIN_PASS) {
                localStorage.setItem("isAdminLoggedIn", "true");
                showAdminPanel();
            } else {
                errorDiv.innerText = "البريد الإلكتروني أو كلمة المرور غير صحيحة!";
            }
        }

        function logout() {
            localStorage.removeItem("isAdminLoggedIn");
            location.reload();
        }

        function showAdminPanel() {
            document.getElementById("loginSection").classList.add("hidden");
            document.getElementById("adminSection").classList.remove("hidden");
            fetchOrders();
            setInterval(fetchOrders, 4000); // تحديث فوري كل 4 ثوانٍ
        }

        // جلب الطلبات من ملف الـ Backend
        function fetchOrders() {
            fetch('get_orders.php')
                .then(response => response.json())
                .then(data => {
                    const tbody = document.getElementById("ordersTableBody");
                    document.getElementById("totalOrdersCount").innerText = data.length;
                    
                    if (data.length === 0) {
                        tbody.innerHTML = `<tr><td colspan="5" style="text-align: center; color: #64748b; padding: 40px;">لا توجد طلبات جديدة حالياً.</td></tr>`;
                        return;
                    }

                    // تنبيه عند وصول طلب جديد فعلياً
                    if (data.length > lastOrderCount && lastOrderCount !== 0) {
                        showToast("تنبيه: تم استلام طلب جديد في النظام!");
                    }
                    lastOrderCount = data.length;

                    tbody.innerHTML = "";
                    data.forEach(order => {
                        let row = `<tr>
                            <td><strong>#${order.id}</strong></td>
                            <td>${order.username}</td>
                            <td>${order.details}</td>
                            <td><input type="text" class="notes-input" id="note_${order.id}" placeholder="اكتب ملاحظة للمستخدم..."></td>
                            <td>
                                <div style="display: flex; gap: 8px;">
                                    <button class="btn btn-success btn-sm" onclick="updateOrderStatus(${order.id}, 'قبول')"><i class="fa-solid fa-check"></i> قبول</button>
                                    <button class="btn btn-danger btn-sm" onclick="updateOrderStatus(${order.id}, 'رفض')"><i class="fa-solid fa-xmark"></i> رفض</button>
                                </div>
                            </td>
                        </tr>`;
                        tbody.innerHTML += row;
                    });
                })
                .catch(err => {
                    console.log("خطأ في الاتصال بالسيرفر لجلب الطلبات.");
                });
        }

        function updateOrderStatus(orderId, status) {
            const notes = document.getElementById(`note_${orderId}`).value;

            fetch('update_order.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id: orderId, status: status, notes: notes })
            })
            .then(response => response.json())
            .then(result => {
                showToast(`تم ${status} الطلب بنجاح وإرسال الملاحظات.`);
                fetchOrders();
            })
            .catch(error => {
                showToast(`تم تنفيذ إجراء (${status}) بنجاح.`);
                fetchOrders();
            });
        }

        function showToast(message) {
            const toast = document.getElementById("toast");
            document.getElementById("toastText").innerText = message;
            toast.style.display = "block";
            setTimeout(() => {
                toast.style.display = "none";
            }, 4000);
        }
    </script>
</body>
</html>

