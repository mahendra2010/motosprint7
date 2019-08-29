@foreach($products as $product)
    {{ $product->bike_name }}
    {{ $product->brand->brand_name}}
@endforeach