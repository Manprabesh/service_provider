<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <h1>My dashboard</h1>
   @if (session('provider'))
       <div>{{session('provider')['email']}}</div>
   @endif

   <h1>My services</h1>
   <table  border="1" cellpadding="10">
<tr>
    <th>user name</th>
    <th>Money Earn</th>
    <th>services</th>
    <th>Location</th>
    <th>Status</th>
    <th>Review</th>
   </tr>

     <tbody id="table_row">
        <!-- Data will be inserted here -->
    </tbody>
   </table>
</body>
<script>

    // Fetch -> Get Data -> Display Data
    let display_data=null;
fetch('/provider/dashboard-data', {
    method: 'GET',
})
.then(response => response.json())
.then(data => {
    display_data=data;
    const container = document.getElementById('table_row');
    console.log()
//  data.forEach((key)=>{
    // console.log()

   data[0].data.forEach((x)=>{

    const tr=document.createElement('tr')
    const td1 = document.createElement('td');
    td1.innerHTML = x.review_data;
    tr.appendChild(td1);

    const td2 = document.createElement('td');
    td2.innerHTML = x.money;
    tr.appendChild(td2);

    const td3 = document.createElement('td');
    td3.innerHTML = x.status;
    tr.appendChild(td3);

    container.appendChild(tr)
    console.log(x)})
 })
// })
.catch(err => console.error("Error while fetching provider dashboard data", err));

if(display_data){

    console.log('display', display_data)
}
</script>
</html>