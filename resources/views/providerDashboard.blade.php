<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Provider Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          animation: {
            'fade-in': 'fadeIn 0.5s ease-in-out',
            'slide-up': 'slideUp 0.6s ease-out',
            'bounce-in': 'bounceIn 0.8s ease-out',
          }
        }
      }
    }
  </script>
  <style>
    @keyframes fadeIn {
      from {
        opacity: 0;
      }

      to {
        opacity: 1;
      }
    }

    @keyframes slideUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes bounceIn {
      0% {
        opacity: 0;
        transform: scale(0.3);
      }

      50% {
        opacity: 1;
        transform: scale(1.05);
      }

      70% {
        transform: scale(0.9);
      }

      100% {
        transform: scale(1);
      }
    }
  </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-indigo-900 via-purple-900 to-pink-800">
  <div class="container mx-auto px-4 py-8 max-w-7xl">

    <!-- Header Section -->
    <div class="bg-white/10 backdrop-blur-lg rounded-3xl p-8 mb-8 shadow-2xl border border-white/20 animate-fade-in">
      <div class="flex flex-col md:flex-row md:items-center md:justify-between">
        <div>
          <h1 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-cyan-400 via-purple-400 to-pink-400 bg-clip-text text-transparent mb-4">
            My Dashboard

          </h1>
          <div class="inline-flex items-center space-x-2 bg-gradient-to-r from-cyan-500 to-purple-600 text-white px-6 py-3 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 animate-bounce-in">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
            </svg>
            <span id="user-email" class="font-medium">Welcome back </span>
          </div>
        </div>
        <div class="mt-4 md:mt-0">
          <div class="text-white/80 text-sm">
            <div class="bg-white/10 px-4 py-2 rounded-lg backdrop-blur-sm">
              <span class="text-cyan-300">●</span> Online
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Services Section -->
    <div class="bg-white/10 backdrop-blur-lg rounded-3xl p-8 shadow-2xl border border-white/20 animate-slide-up">
      <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl md:text-4xl font-bold text-white">
          My Services
        </h1>
        <div class="flex items-center space-x-2 bg-emerald-500 text-white px-4 py-2 rounded-full text-sm font-medium">
          <div class="w-2 h-2 bg-white rounded-full animate-pulse"></div>
          <span>Live Data</span>
        </div>
      </div>

      <!-- Loading State -->
      <div id="loading-state" class="text-center py-12">
        <div class="inline-flex items-center space-x-3 text-white/70">
          <div class="w-6 h-6 border-2 border-white/30 border-t-white rounded-full animate-spin"></div>
          <span class="text-lg">Loading your services...</span>
        </div>
      </div>

      <!-- Table Container -->
      <div id="table-container" class="hidden overflow-x-auto">
        <div class="min-w-full bg-white/5 backdrop-blur-sm rounded-2xl border border-white/10 overflow-hidden">
          <table class="min-w-full">
            <thead class="bg-gradient-to-r from-purple-600/50 to-pink-600/50">
              <tr>
                <th class="px-6 py-4 text-left text-sm font-semibold text-white uppercase tracking-wider">
                  <div class="flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                    </svg>
                    <span>User Name</span>
                  </div>
                </th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-white uppercase tracking-wider">
                  <div class="flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd" />
                    </svg>
                    <span>Money Earned</span>
                  </div>
                </th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-white uppercase tracking-wider">
                  <div class="flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span>Status</span>
                  </div>
                </th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-white uppercase tracking-wider">
                  <div class="flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z" clip-rule="evenodd" />
                    </svg>
                    <span>Review</span>
                  </div>
                </th>
              </tr>
            </thead>
            <tbody id="table_row" class="divide-y divide-white/10">
              <!-- Data will be inserted here -->
            </tbody>
          </table>
        </div>
      </div>

      <!-- Empty State -->
      <div id="empty-state" class="hidden text-center py-12">
        <div class="text-white/50">
          <svg class="w-16 h-16 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm0 4a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
          </svg>
          <p class="text-lg">No services found</p>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Original functionality preserved exactly
    let display_data = null;

    // Show user email if session exists
    if (typeof session !== 'undefined' && session('provider')) {
      document.getElementById('user-email').textContent = session('provider')['email'];
    }

    // Function to get status badge styling
    function getStatusBadge(status) {
      const statusLower = status.toLowerCase();
      if (statusLower.includes('active') || statusLower.includes('completed')) {
        return 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/30';
      } else if (statusLower.includes('pending')) {
        return 'bg-yellow-500/20 text-yellow-300 border border-yellow-500/30';
      } else if (statusLower.includes('cancelled') || statusLower.includes('rejected')) {
        return 'bg-red-500/20 text-red-300 border border-red-500/30';
      } else {
        return 'bg-blue-500/20 text-blue-300 border border-blue-500/30';
      }
    }

    // Function to format money
    function formatMoney(amount) {
      return new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD'
      }).format(amount);
    }

    // Fetch -> Get Data -> Display Data (Original functionality preserved)
    fetch('/provider/dashboard-data', {
        method: 'GET',
      })
      .then(response => response.json())
      .then(data => {
        display_data = data;
        // if(!data){
        //   alert("no data")
        // }
        const container = document.getElementById('table_row');
        const loadingState = document.getElementById('loading-state');
        const tableContainer = document.getElementById('table-container');
        const emptyState = document.getElementById('empty-state');

        console.log("incoming data",data);

        // Hide loading state
        loadingState.classList.add('hidden');

        if (data[0] && data[0].data && data[0].data.length > 0) {
          // Show table
          tableContainer.classList.remove('hidden');

          data[0].data.forEach((x, index) => {
            const tr = document.createElement('tr');
            tr.className = 'hover:bg-white/5 transition-colors duration-200';
            tr.style.animationDelay = `${index * 0.1}s`;
            tr.classList.add('animate-fade-in');

            // User Email
            const td1 = document.createElement('td');
            td1.className = 'px-6 py-4 whitespace-nowrap';
            td1.innerHTML = `
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-gradient-to-r from-cyan-500 to-purple-600 rounded-full flex items-center justify-center text-white text-sm font-medium mr-3">
                        ${x.user_email.charAt(0).toUpperCase()}
                    </div>
                    <div class="text-white font-medium">${x.user_email}</div>
                </div>
            `;
            tr.appendChild(td1);

            // Money
            const td2 = document.createElement('td');
            td2.className = 'px-6 py-4 whitespace-nowrap';
            td2.innerHTML = `
                <div class="text-emerald-400 font-semibold text-lg">
                    ${formatMoney(x.money)}
                </div>
            `;
            tr.appendChild(td2);

            // Status
            const td3 = document.createElement('td');
            td3.className = 'px-6 py-4 whitespace-nowrap';
            const statusBadgeClass = getStatusBadge(x.status);
            td3.innerHTML = `
                <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full ${statusBadgeClass}">
                    ${x.status}
                </span>
            `;
            tr.appendChild(td3);

            // Review
            const td4 = document.createElement('td');
            td4.className = 'px-6 py-4';
            td4.innerHTML = `
                <div class="text-white/80 max-w-xs">
                    ${x.review_data || 'No review yet'}
                </div>
            `;
            tr.appendChild(td4);

            container.appendChild(tr);
            console.log(x);
          });
        } else {
          // Show empty state
          emptyState.classList.remove('hidden');
        }
      })
      .catch(err => {
        console.error("Error while fetching provider dashboard data", err);
        const loadingState = document.getElementById('loading-state');
        const emptyState = document.getElementById('empty-state');

        loadingState.classList.add('hidden');
        emptyState.classList.remove('hidden');
        emptyState.innerHTML = `
        <div class="text-center py-12">
            <div class="text-red-400">
                <svg class="w-16 h-16 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
                <p class="text-lg">Error loading services</p>
                <p class="text-sm text-white/50 mt-2">Please try refreshing the page</p>
            </div>
        </div>
    `;
      });

    // Original console log preserved
    if (display_data) {
      console.log('display', display_data);
    }
  </script>
</body>

</html>