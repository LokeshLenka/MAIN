<form action="{{ route('psrpost') }}" method="post" enctype="application/json">
    @csrf
    {{-- <input type="file" name="file"/> --}}
    {{-- <input type="json" name="products"> First Name
    <input type="text" name="LastName" >Last Name --}}
    <input type="text" placeholder="Titel" name="products[0]" :value="old('products[0]')">
    <input type="text" placeholder="Titel" name="products[1]">
    <button type="submit">Submit</button>
</form>
