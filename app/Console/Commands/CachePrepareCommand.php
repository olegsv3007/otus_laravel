<?php

namespace App\Console\Commands;

use App\Models\Apartment;
use App\Models\City;
use App\Models\Country;
use App\Models\Hotel;
use App\Models\Organization;
use App\Services\Cms\Apartments\Repositories\ApartmentRepository;
use App\Services\Cms\Cities\Repositories\CityRepository;
use App\Services\Cms\Countries\Repositories\CountryRepository;
use App\Services\Cms\Hotels\Repositories\HotelRepository;
use App\Services\Cms\Organizations\Repositories\OrganizationRepository;
use Illuminate\Console\Command;

class CachePrepareCommand extends Command
{
    protected $signature = 'cache:prepare
                            {model?* : Prepare cache for concrete model}
                            {--S|silent : Make it silent}';

    protected $description = 'Prepare cache for application';

    protected const MODELS = [
        Country::class,
        City::class,
        Organization::class,
        Hotel::class,
        Apartment::class,
    ];

    public function __construct(
        private CountryRepository $countryRepository,
        private CityRepository $cityRepository,
        private OrganizationRepository $organizationRepository,
        private HotelRepository $hotelRepository,
        private ApartmentRepository $apartmentRepository,
    )
    {
        parent::__construct();
    }

    public function handle()
    {
        $silent = $this->option('silent');
        $models = $this->argument('model') ?? [];

        if (!$silent && ($diffModels = array_diff($models, self::MODELS))) {
            foreach ($diffModels as $model) {
                $this->error($this->getErrorMessage($model));
            }

            $this->newLine(2);
        }

        if (!$models || in_array(Country::class, $models)) {

            $this->countryRepository->get();

            if (!$silent) {
                $this->info($this->getSuccessMessage(Country::class));
            }
        }

        if (!$models || in_array(City::class, $models)) {

            $this->cityRepository->get();

            if (!$silent) {
                $this->info($this->getSuccessMessage(City::class));
            }
        }

        if (!$models || in_array(Organization::class, $models)) {

            $this->organizationRepository->get();

            if (!$silent) {
                $this->info($this->getSuccessMessage(Organization::class));
            }
        }

        if (!$models || in_array(Hotel::class, $models)) {

            $this->hotelRepository->get();

            if (!$silent) {
                $this->info($this->getSuccessMessage(Hotel::class));
            }
        }

        if (!$models || in_array(Apartment::class, $models)) {

            $this->apartmentRepository->get();

            if (!$silent) {
                $this->info($this->getSuccessMessage(Apartment::class));
            }
        }

        return 0;
    }

    private function getSuccessMessage(string $modelName)
    {
        return "Cache prepared for model: {$modelName}";
    }

    private function getErrorMessage(string $modelName)
    {
        return "Can't prepare cache for model: {$modelName}";
    }

}
