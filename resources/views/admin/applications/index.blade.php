<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>THC Admin | Applications</title>
<link rel="icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
* {margin:0; padding:0; box-sizing:border-box; font-family:'Inter', sans-serif;}
body { display:flex; min-height:100vh; background:#f5f7fa; }

/* Sidebar */
.sidebar {
    width:250px; background:#0a3d62; color:white; flex-shrink:0; display:flex; flex-direction:column;
}
.sidebar .logo { text-align:center; padding:20px 0; border-bottom:1px solid rgba(255,255,255,0.2);}
.sidebar .logo img { width:130px; display:block; margin:0 auto; }
.sidebar nav { flex:1; display:flex; flex-direction:column; }
.sidebar nav a {
    display:block; padding:15px 20px; color:white; text-decoration:none; transition:0.2s;
}
.sidebar nav a:hover { background:#1e5aa8; }
.sidebar .profile { padding:15px 20px; border-top:1px solid rgba(255,255,255,0.1); font-size:14px; }

/* Main content */
.main { flex:1; padding:20px 30px; display:flex; flex-direction:column; }
.navbar { display:flex; justify-content:flex-end; align-items:center; margin-bottom:20px; }
.navbar form button { background:#e74c3c; border:none; color:white; padding:6px 12px; border-radius:6px; cursor:pointer; }

/* Stats Cards */
.cards { display:grid; grid-template-columns:repeat(auto-fit,minmax(180px,1fr)); gap:20px; margin-bottom:30px; }
.card {
    background:white; padding:20px; border-radius:12px; box-shadow:0 10px 25px rgba(0,0,0,.08);
    display:flex; flex-direction:column; align-items:center; justify-content:center; transition: transform 0.2s;
}
.card:hover { transform: translateY(-5px); }
.card h3 { margin-bottom:10px; font-size:1rem; text-align:center; display:flex; align-items:center; gap:5px; }
.card p { font-size:24px; font-weight:700; margin:0; }

/* Table */
table { width:100%; border-collapse:collapse; background:white; box-shadow:0 10px 25px rgba(0,0,0,.08); border-radius:8px; overflow:hidden; }
th,td { padding:12px; border-bottom:1px solid #eee; vertical-align:middle; }
th { background:#0a3d62; color:white; text-align:left; }
.badge { padding:5px 10px; border-radius:6px; font-size:12px; font-weight:600; display:inline-block; }
.pending{background:#fbbf24;color:#000;}
.approved{background:#16a34a;color:white;}
.rejected{background:#dc2626;color:white;}
button { padding:6px 10px; border:none; border-radius:6px; cursor:pointer; }
.approve{background:#16a34a;color:white;}
.reject{background:#dc2626;color:white;}
.receipt-thumb { max-width:50px; max-height:50px; border-radius:4px; border:1px solid #ccc; margin-right:5px; }

/* Actions buttons layout */
.actions {
    display:flex;
    flex-wrap:wrap;
    gap:5px;
    align-items:center;
}
.actions form { margin:0; display:inline-block; }
.actions a.edit {
    background:#0a3d62; color:white; padding:6px 10px; border-radius:4px; text-decoration:none; font-size:0.875rem;
}
.actions button.delete { background:#b91c1c; color:white; padding:6px 10px; border-radius:4px; font-size:0.875rem; }
.actions button.approve { background:#16a34a; color:white; padding:6px 10px; border-radius:4px; font-size:0.875rem; }
.actions button.reject { background:#dc2626; color:white; padding:6px 10px; border-radius:4px; font-size:0.875rem; }

/* Modal */
.modal { display:none; position:fixed; z-index:1000; left:0; top:0; width:100%; height:100%; background:rgba(0,0,0,0.6); align-items:center; justify-content:center; }
.modal-content { background:white; padding:20px; border-radius:8px; max-width:90%; max-height:90%; overflow:auto; text-align:center; position:relative; }
.modal-content img { max-width:100%; max-height:80vh; border-radius:6px; }
.modal-close { position:absolute; top:10px; right:10px; font-size:20px; font-weight:bold; cursor:pointer; }

/* Heading */
h3.section-title { margin-bottom:15px; color:#0a3d62; }

/* Pagination */
.pagination { margin-top:15px; display:flex; justify-content:flex-end; }
.pagination a, .pagination span { margin-left:5px; padding:6px 12px; background:white; border-radius:6px; text-decoration:none; border:1px solid #ddd; color:#0a3d62; }
.pagination span {background:#0a3d62;color:white;}
.pagination a:hover {background:#0a3d62;color:white;}
</style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <div class="logo">
        <img src="{{ asset('img/logo.png') }}" alt="THC Logo">
    </div>
    <nav>
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.applications.index') }}">Applications</a>
        <a href="#">Settings</a>
    </nav>
    <div class="profile">
        Logged in as: <strong>{{ auth()->user()?->name }}</strong>
    </div>
</div>

<!-- Main -->
<div class="main">
    <!-- Top Navbar -->
    <div class="navbar">
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>

    <!-- Overview Stats Cards -->
    {{-- <div class="cards">
        <div class="card total">
            <h3>Total Applications</h3>
            <p>{{ $total ?? 0 }}</p>
        </div>
        <div class="card pending">
            <h3>Pending</h3>
            <p>{{ $pending ?? 0 }}</p>
        </div>
        <div class="card approved">
            <h3>Approved</h3>
            <p>{{ $approved ?? 0 }}</p>
        </div>
        <div class="card rejected">
            <h3>Rejected</h3>
            <p>{{ $rejected ?? 0 }}</p>
        </div>
    </div> --}}

    <!-- Recent Applications Table -->
    @if(isset($applications) && $applications->count() > 0)
        <h3 class="section-title">Recent Applications</h3>
        <table>
            <thead>
            <tr>
                <th>Ref</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Status</th>
                <th>Receipt</th>
                <th>Membership ID</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($applications as $app)
                <tr>
                    <td>{{ $app->application_ref }}</td>
                    <td>{{ $app->full_name }}</td>
                    <td>{{ $app->phone }}</td>
                    <td>{{ $app->email }}</td>
                    <td>
                        <span class="badge {{ $app->status }}">
                            {{ ucfirst($app->status) }}
                        </span>
                    </td>
                    <td>
                        @if($app->receipt_path)
                            @if(in_array(pathinfo($app->receipt_path, PATHINFO_EXTENSION), ['jpg','jpeg','png']))
                                <img src="{{ Storage::url($app->receipt_path) }}" class="receipt-thumb" alt="Receipt" style="cursor:pointer;" onclick="openModal('{{ Storage::url($app->receipt_path) }}')">
                            @else
                                <a href="{{ Storage::url($app->receipt_path) }}" target="_blank">View</a>
                            @endif
                        @endif
                    </td>
                    <td>{{ $app->membership_id ?? '-' }}</td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('admin.applications.edit', $app) }}" class="edit">Edit</a>
                            <form method="POST" action="{{ route('admin.applications.destroy', $app) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                            @if($app->status=='pending')
                                <form method="POST" action="{{ route('admin.applications.approve',$app) }}">
                                    @csrf
                                    <button type="submit" class="approve">Approve</button>
                                </form>
                                <form method="POST" action="{{ route('admin.applications.reject',$app) }}">
                                    @csrf
                                    <button type="submit" class="reject">Reject</button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="pagination">
            {{ $applications->links() }}
        </div>
    @else
        <p>No recent applications.</p>
    @endif

</div>

<!-- Receipt Modal -->
<div class="modal" id="receiptModal">
    <div class="modal-content">
        <span class="modal-close" onclick="closeModal()">&times;</span>
        <img id="modalImg" src="" alt="Receipt">
    </div>
</div>

<script>
function openModal(src) {
    document.getElementById('modalImg').src = src;
    document.getElementById('receiptModal').style.display = 'flex';
}
function closeModal() {
    document.getElementById('receiptModal').style.display = 'none';
}
window.onclick = function(event) {
    if(event.target == document.getElementById('receiptModal')) {
        closeModal();
    }
}
</script>

</body>
</html>
