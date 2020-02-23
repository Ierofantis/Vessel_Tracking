<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ShipPosition;

class ShipsPositionsImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:ships-positions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import ships positions to mongodb collection';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $filename = base_path('data-imports/ships_positions_22_02_2020.json');
        $json = json_decode(file_get_contents($filename), true);

        \Log::info('Import ships positions to mongodb collection has started');

        foreach ($json as $ship_position) {

            try {

                $data = [
                    'mmsi' => $ship_position['mmsi'] ? $ship_position['mmsi'] : null,
                    'status' => $ship_position['status'] ? $ship_position['status'] : null,
                    'stationId' => $ship_position['stationId'] ? $ship_position['stationId'] : null,
                    'speed' => $ship_position['speed'] ? $ship_position['speed'] : null,
                    'lon' => $ship_position['lon'] ? $ship_position['lon'] : null,
                    'lat' => $ship_position['lat'] ? $ship_position['lat'] : null,
                    'course' => $ship_position['course'] ? $ship_position['course'] : null,
                    'heading' => $ship_position['heading'] ? $ship_position['heading'] : null,
                    'rot' => $ship_position['rot'] ? $ship_position['rot'] : null,
                    'timestamp' => $ship_position['timestamp'] ? $ship_position['timestamp'] : null,
                ];

                $ship_position = ShipPosition::create($data);
            } catch (\Exception $e) {

                \Log::error($e->getMessage());
            }
        }
        \Log::info('Import ships positions to mongodb collection is stopped');
    }
}
