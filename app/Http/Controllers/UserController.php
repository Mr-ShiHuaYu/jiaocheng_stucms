<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.index');
    }

    public function getUser()
    {
        // page=1&limit=10
        $page = request()->input('page'); // 第几页
        $limit = request()->input('limit'); // 每页多少条数据
        $offset = ($page - 1) * $limit; // 偏移
        $keyword = request()->input('keyword');
        $query = \App\Models\User::query();

        if ($keyword) {
            $cols = \Schema::getColumnListing('users');
            // 去除搜索的列
            $cols = array_diff($cols, ['password']);
            $sql = [];
            foreach ($cols as $col) {
                $sql[] = "IFNULL($col,'')";
            }
            $sql = join(',', $sql);
            $query = $query->whereRaw("CONCAT($sql) like '%$keyword%'");
        }
        $data = $query->offset($offset)->paginate($limit)->toArray();

        return [
            'data' => $data['data'],
            'code' => 0,
            'msg' => '获取数据失败',
            'count' => $data['total'],
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
