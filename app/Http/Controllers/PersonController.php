<?php
namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class PersonController extends Controller
{
    const GENERAL_KEYS = 'persons';
    const PAGE_SIZE = 20;
    const CACHE_EXPIRY_INSECOND = 60;
    const SEARCH_COLUMN = 'birthday';

    public $year;
    public $month;
    public $key;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->year = $request->input('year')??0;
        $this->month = $request->input('month')??0;
        $this->key = $this->searchKeys();

        $year = $this->year;
        $month = $this->month;

        $persons = Redis::get($this->key);
        if (isset($persons) && !empty($persons))
        {
            $persons = json_decode($persons, false);
        }
        else
        {
            $persons = $this->getPagingData();
            Redis::set($this->key, json_encode($persons) , 'EX', self::CACHE_EXPIRY_INSECOND);
        }

        $personInfo = $this->getPagingData();

        return view('persons.index', compact('personInfo','year','month'))
            ->with('i', (request()
            ->input('page', 1) - 1) * 20);

    }

    private function getPagingData()
    {
        if ($this->year == 0 && $this->month != 0)
        {
            return Person::whereMonth(self::SEARCH_COLUMN, $this->month)
                ->paginate(self::PAGE_SIZE);
        }
        else if ($this->year != 0 && $this->month == 0)
        {
            return Person::whereYear(self::SEARCH_COLUMN, $this->year)
                ->paginate(self::PAGE_SIZE);
        }
        else if ($this->year != 0 && $this->month != 0)
        {
            return Person::whereYear(self::SEARCH_COLUMN, $this->year)
                ->whereMonth(self::SEARCH_COLUMN, $this->month)
                ->paginate(self::PAGE_SIZE);
        }

        return Person::paginate(self::PAGE_SIZE);

    }

    private function sortData()
    {
        return ['sortBy' => 'id', 'sortOrder' => 'ASC'];
    }

    private function searchKeys()
    {
        $key = [$this->year, $this->month];

        return self::GENERAL_KEYS . '-' . implode('-', $key);
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
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function edit(Person $person)
    {
        //
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Person $person)
    {
        //
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person)
    {
        //
        
    }
}

