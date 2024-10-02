<div style="width: 250px; background-color: #2d3748; color: white; height: 100vh; position: fixed; padding: 20px;">
    <h3 style="font-weight: bold; color: #ffffff;">Admin Panel</h3>
    <ul style="list-style: none; padding: 0; margin-top: 20px;">
        <li style="margin-bottom: 10px;">
            <a href="{{ url('/analytics') }}" style="color: #ffffff; text-decoration: none; padding: 10px; display: block; border-radius: 5px; transition: background 0.3s;">Analytics</a>
        </li>
        <li style="margin-bottom: 10px;">
            <a href="{{ url('/admin/customers') }}" style="color: #ffffff; text-decoration: none; padding: 10px; display: block; border-radius: 5px; transition: background 0.3s;">View Customers</a>
        </li>
        <li style="margin-bottom: 10px;">
            <a href="{{ url('/admin/businesses') }}" style="color: #ffffff; text-decoration: none; padding: 10px; display: block; border-radius: 5px; transition: background 0.3s;">View Businesses</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('products.index') }}">Products</a>
        </li>
    </ul>
</div>

<style>
    /* Hover effect */
    a:hover {
        background-color: #4a5568; /* Darker shade on hover */
    }

    /* Active link style */
    a.active {
        background-color: #4a5568; /* Dark shade for active link */
    }
</style>
