<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    $images=[
        "/storage/uploads/nHhZtKnbQn9Ol20z9OrAmQWM1rqK297sdneAmIql.jpeg",
        "/storage/uploads/lATn9iXgVdLCYAXtME25DxTr4yXX0t0UMfsBREUH.jpeg",
        "/storage/uploads/7wJDoOWnLXjVzJ0mLn06QygqgJndkGP6cNZdt5yt.jpeg",
        "/storage/uploads/7nvFUMMdtNwlSfRW2j4xDiQ4yL3vM5QG9w05V5K1.jpeg",
        "/storage/uploads/B1zLxceZt3ErimpXUgYehQcMaI12mNxkzHaXLnKL.jpeg",
        "/storage/uploads/o6W9UVyXNnEBbmv8mivUDpg2DWAjymHed87KTZdS.jpeg",
        "/storage/uploads/N4X1QStUdQJ9I7WBjoKislzZDDFGGDUgJOUCjWsk.jpeg",
        "/storage/uploads/ynacM8qVlcawshONrA5D3C50MCxrYsu6TRLBW83N.jpeg",
        "/storage/uploads/YjuIz24bpw2D9kAswskaZEwlcx754Oqe6JfkYPmQ.jpeg",
        "/storage/uploads/2VphBHfphjDmES4Shp8RJjTrlUsfXOrQiyIJ2JiV.jpeg",
        "/storage/uploads/Cyl2zv8pcaKVaAV3WE7EdmX6SXFlPnqnNyHygXwk.jpeg",
        "/storage/uploads/L1gCPEc6euU9qukWdUbF7vKv08TceHMdy0IPnGD0.jpeg",
        "/storage/uploads/ZHKhaGAZtJg8WWyGlg5fYu2Cj2qblFg08sL4ZUyQ.jpeg",
        "/storage/uploads/qQV6yFCLi1dBzdVH1Iu0RTQdbmDESLXIJXdMiYz3.jpeg",
        "/storage/uploads/1Nka9Aa2AKyrHeioM4dSGy4oH6UHSutWR5ZgvpBC.jpeg",
        "/storage/uploads/cl1dDeGolRPZJOItrV4NcIy80dpvCHUVojMpJfOC.jpeg",
        "/storage/uploads/Lfdf4IvpCZQuGLm09Pqu0WPx11DSpgJyS35Wz2M0.jpeg",
        "/storage/uploads/n9iZfXEF635PObeR2CnYxoQvwnTcGuXmXw5sy6Ty.jpeg",
        "/storage/uploads/6g0Plehdx2FBgub1LjMWLDG72mMw00lLkFwrI1lZ.jpeg",
        "/storage/uploads/GbIFtGfky0DtbKdEw0nlAgtNN2X79bEJmiuUKLfB.jpeg",
        "/storage/uploads/Dk5J9wDmAbxsxkd968mKNrAfOTuQ12zUy27kexWd.jpeg",
        "/storage/uploads/27uSbBeDisKajJCUQBP6agwtRabPrETePEctqdT8.jpeg",
        "/storage/uploads/1r7snP8qug7ZcIHUUD6x1WWRvjWHUwHyodpqdDwJ.jpeg",
        "/storage/uploads/lLaZcQtdlTH3uEvSPhyZahtf1dF5Gbf9C9nMNIAb.jpeg",
        "/storage/uploads/ZKxqWyc6OqCYMqRG8erg7p3gHu3KmFX2bblb54P2.jpeg",
        "/storage/uploads/yVP7kKbDtPBCeAtoKlCXFc7z8L6Ty32vR0xwypsI.jpeg",
        "/storage/uploads/tTDHm0YpfRUK6ZeM2PNscW3D2Dl84ugzHZRznSDO.jpeg",
    ];
    return [
        'user_id'=>factory(\App\User::class)->create(),
        'title'=>$faker->title,
        'description'=>$faker->paragraph,
        'url'=>$faker->url,
        'image'=>$faker->randomElement($images)
    ];
});
