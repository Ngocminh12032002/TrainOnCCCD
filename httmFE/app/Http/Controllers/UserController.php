<?php

namespace App\Http\Controllers;

use App\Services\httmServices;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $httmService;

    public function __construct()
    {
        $this->httmService = new httmServices();
    }

    public function index()
    {
        return view("login");
    }
    public function login(Request $request)
    {
        try {
            $data = $request->validate([
                'email' => 'required',
                'password' => 'required',
            ]);
            $user = $this->httmService->login($request->email, $request->password);
            if ($user->results === true) {
                return view('welcome');
            } else {
                return redirect()->back()->with('error', 'Tên tài khoản hoặc mật khẩu không chính xác');
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', '');
        }
    }

    public function train(Request $request)
    {
        try {
            // dd($request);
            $file = $request->file('fileInput');
            if ($file) {
                $data = $this->httmService->train($file);
                return redirect()->back()->with('data', $data);
            } else {
                dd('No file uploaded');
            }

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', '');
        }
    }

    public function manageModel(Request $request)
    {
        $data = $this->httmService->listModel();
        return view('danhsachModel', ['data' => $data]);
    }

    public function list(Request $request)
    {
        $data = $this->httmService->list();
        return view('danhsachmau', ['data' => $data]);
    }

    public function delete($id)
    {
        try {
            $result = $this->httmService->delete($id);
            if ($result->results === true) {
                return back()->with('success', 'Xóa thành công');
            } else {
                return redirect()->back()->with('error', 'Xóa không thành công');
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
            return back()->with('error', $error);
        }
    }

    public function update($id, Request $request)
    {
        try {
            $file = $request->file('fileInput');
            $result = $this->httmService->update($id, $file);
            if ($result->results === true) {
                return back()->with('success', 'Sửa thành công');
            } else {
                return redirect()->back()->with('error', 'Sửa không thành công');
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
            return back()->with('error', $error);
        }
    }

    public function retrain(Request $request)
    {
        $id = $request->input('selectedIds');
        $weight = $request->input('weight');
        $data = $this->httmService->retrain($id, $weight);
        if ($data->results === true) {
            return view('success')->with('success', 'Retrain thành công');
        } else {
            return view('failed')->with('error', 'Retrain không thành công');
        }
    }

    public function listWeight()
    {
        $data = $this->httmService->listWeight();
        dd($data);
    }

    public function home()
    {
        return view('welcome');
    }

    public function detail($id)
    {
        $data = $this->httmService->detailModel($id);
        return view('chitietModel', ['data' => $data]);
    }

    public function updateModel($id, Request $request)
    {
        try {
            $input = $request->input('nameEdit');
            $data = $this->httmService->updateModel($id, $input);
            if ($data->results === true) {
                return back()->with('success', 'Sửa thành công');
            } else {
                return redirect()->back()->with('error', 'Sửa không thành công');
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function deleteModel($id)
    {
        $data = $this->httmService->deleteModel($id);
        if ($data->results === true) {
            return back()->with('success', 'Sửa thành công');
        } else {
            return redirect()->back()->with('error', 'Sửa không thành công');
        }
    }
}
