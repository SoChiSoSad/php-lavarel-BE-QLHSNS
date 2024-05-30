<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePersonnelRequest;
use App\Http\Requests\UpdatePersonnelRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class PersonnelController extends Controller
{
    public function index()
    {
        $personnels = User::whereHas('roles', function ($query) {
            $query->where('name', 'personnel');
        })->get();

        return response()->json([
            'success' => true,
            'message' => 'Lấy danh sách nhân sự thành công.',
            'data' => $personnels,
        ]);
    }

    public function store(StorePersonnelRequest $request)
    {
        try {
            $personnel = User::create($request->validated()); 
            $personnelRole = Role::where('name', 'personnel')->first();

            if (!$personnelRole) {
                return response()->json([
                    'success' => false,
                    'message' => 'Vai trò "personnel" không tồn tại.',
                ], 500);
            }
    
            $personnel->assignRole($personnelRole);
    
            return response()->json([
                'success' => true,
                'message' => 'Tạo nhân sự mới thành công.',
                'data' => $personnel,
            ], 201); 

        } catch (\Exception $e) {    
            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi khi tạo nhân sự.',
                'error' => $e->getMessage(), 
            ], 500); 
        }
    }

    public function show(User $user)
    {
        try {
            return response()->json([
                'success' => true,
                'message' => 'Lấy thông tin nhân sự thành công.',
                'data' => $user,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi khi lấy thông tin nhân sự.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(UpdatePersonnelRequest $request, User $user)
    {
        try {
            $user->update($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Cập nhật thông tin nhân sự thành công.',
                'data' => $user,
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi khi cập nhật thông tin nhân sự.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(User $user)
    {
        try {
            $user->roles()->detach(); 
            $user->delete(); 

            return response()->json([
                'success' => true,
                'message' => 'Xóa nhân sự thành công.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi khi xóa nhân sự.',
                'error' => $e->getMessage(), 
            ], 500); 
        }
    }
}
