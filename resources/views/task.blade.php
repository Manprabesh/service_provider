<h1>My Task</h1>
@foreach ($services as $task)
<ol>
    <li>{{ $task['service_id'] }}</li>
    <li>{{ $task['service_name'] }}</li>
    <li>{{ $task['email'] }}</li>
    <li>{{ $task['price'] }}</li>
    <li>{{ $task['status'] }}</li>
</ol>
@endforeach