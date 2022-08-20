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

    public function search()
    {
        $search = $_GET['search'];
        if ($search === "") {                                       //
            $data = Customers::get();                                  //return with message if search field is empty
            return view('Admin.Customer.list', compact('data'));      //
        } else {
            $name = Customers::where('Customer_Name', 'LIKE', '%' . $search . '%')->get();            //query search for likeliness in the admin_name column
            $username = Customers::where('Customer_Username', 'LIKE', '%' . $search . '%')->get();    //query search for likeliness in the admin_username column
            $data = $username->union($name);                                                    //combine results
            if ($data->count() !== 0) {
                return view('Admin.Customer.list')                                            //
                    ->with('data', $data)                                                   // return successful search data
                    ->with('notify', 'Showing search results for "' . $search . '".');      //
            } else {
                $data = Customers::get();                                                      //
                return view('Admin.Customer.list')->with('data', $data)                       //return with empty search data.
                    ->with('fail', 'No result found for "' . $search . '".');               //
            }
        }
    }

    //!customer navigation controllers from this point on

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
}
