<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Customers;
use App\Models\Categories;
use Illuminate\Http\Request;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\ProductController;
use Illuminate\Database\DBAL\TimestampType;

class CustomerController extends Controller
{
    public function save(Request $request)
    {
        $request->validate([
            'userName' => 'required|unique:Customers,Customer_Username',
            'name' => 'required',
            'password' => 'required|required_with:confirmPassword|same:confirmPassword',
            'confirmPassword' => 'required',
            'email' => 'required|unique:Customers',
            'phone' => 'required|min:10',
            'address' => 'required',
            'gender' => 'required',
            'DoB' => 'required'
        ]);

        $customers = new Customers();

        $customers->Customer_Username = $request->userName;
        $customers->Customer_Password = Hash::make($request->password);
        $customers->Customer_Name = $request->name;
        $customers->Email = $request->email;
        $customers->Phone = $request->phone;
        $customers->Address = $request->address;
        $customers->Gender = $request->gender;
        $customers->Date_of_Birth = $request->DoB;

        $customers->save();

        return redirect()->back()->with('success', 'Customers added successfully!');
    }

    public function delete($id)
    {
        if ($id) {
            Customers::where('Customer_Username', '=', $id)->delete();
            return redirect()->back()->with('success', 'Customer deleted successfully');
        } else {
            return redirect()->back()->with('fail', 'Failed to delete customer, maybe because none was selected?');
        }
    }

    public function homepage()
    {
        $categories = Categories::get();
        $categoriesF = Categories::inRandomOrder()->limit(6)->get(); //asking to get only 6 categories randomly for featured
        return view('Navigate.home', compact('categoriesF', 'categories'));
    }

    public function shop()
    {
        $categories = Categories::get(); //take database Categories into $categories
        $products = Products::get();
        return view('Navigate.shop', compact('categories'), compact('products'));
    }

    public function about()
    {
        $categories = Categories::get();
        $data = Products::get();
        return view('Navigate.about', compact('data', 'categories'));
    }

    public function contact()
    {
        $categories = Categories::get();
        return view('Navigate.contact', compact('categories'));
    }

    public function shopSingle($id)
    {
        $categories = Categories::get();
        $data = Products::join('Categories', 'Categories.Category_ID', '=', 'Products.Category_ID')
            ->where('Product_ID', '=', $id)->first();

        $image = Products::where('Product_ID', '=', $id)->first();
        return view('Navigate.shopSingle', compact('data', 'categories', 'image'));
    }

    public function cart()
    {
        $categories = Categories::get();
        $data = Products::get();
        return view('Navigate.cart', compact('data', 'categories'));
    }

    //!View customers on admin page
    public function index()
    {
        $data = Customers::get();
        return view('Admin.Customer.list', compact('data'));
    }

    public function shopCategory($id)
    {
        $categories = Categories::get(); //take database Categories into $categories
        $products = Products::where('Category_ID', '=', $id)->get();
        return view('Navigate.shop', compact('categories', 'products'));
    }

    //hanlde when customer addCard
    public function addCart($id)    //This has been an excruciatingly painful experience due to my inexperience in coding as well as my laziness.
    {
        if (isset($_GET['size'])) {
            $product = Products::where('Product_ID', '=', $id)->first();
            $Product_ID = $product->Product_ID;
            $name = $product->Product_Name;
            $size = $_GET['size'];
            $quanity = $_GET['quanity'];
            $price = $product->Price;           //getting the neccessary information
            $img[] = $product->Images;

            $_SESSION['cart'] = array();

            $item = collect([
                "name" => $name,
                "id" => $id,
                "size" => $size,
                "quantity" => $quanity,         //putting them in a collection.
                "price" =>$price,
                "img" => $img[0],
            ]);

            session()->push('cart', $item);     //push new collection to session('cart)

            $categories = Categories::get();
            $products = Products::get();        //dependent product and categories data
            return view('Navigate.shop', compact('products', 'categories'));
        }
    }
}
