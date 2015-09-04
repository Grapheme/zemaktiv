<form action="{{ URL::route('buildings.filter') }}" class="js-houses-filter" method="post">
    <div class="filter__block">
        <div class="block__title">Я хочу</div>
        <div class="block__check">
            <input name="house_build" value="1" type="checkbox" class="js-checkbox js-set-for">
            <label class="js-set-for">Уже готовый дом</label>
        </div>
        <div class="block__check">
            <input name="house_layout" value="1" type="checkbox" class="js-checkbox js-set-for">
            <label class="js-set-for">Построить дом</label>
        </div>
        <div class="block__check">
            <input name="house_all" value="1" type="checkbox" class="js-checkbox js-set-for">
            <label class="js-set-for">Все варианты</label>
        </div>
    </div>
    <div class="filter__block">
        <div class="block__title">Технология</div>
        <?php $index = 1;?>
        @foreach(LayoutHomesController::$materials as $material)
            <div class="block__check">
                <input name="technology_{{ $index }}" value="1" type="checkbox" class="js-checkbox js-set-for">
                <label class="js-set-for">{{ $material }}</label>
            </div>
            <?php $index++;?>
        @endforeach
        <div class="block__check">
            <input name="technology_all" value="1" type="checkbox" class="js-checkbox js-set-for">
            <label class="js-set-for">Все технологии</label>
        </div>
    </div>
    <div class="filter__block">
        <div class="block__title">Площадь дома, кв. м</div>
        <div class="block__check">
            <input name="area_150" value="1" type="checkbox" class="js-checkbox js-set-for">
            <label class="js-set-for">до 150</label>
        </div>
        <div class="block__check">
            <input name="area_151_180" value="1" type="checkbox" class="js-checkbox js-set-for">
            <label class="js-set-for">151-180</label>
        </div>
        <div class="block__check">
            <input name="area_181" value="1" type="checkbox" class="js-checkbox js-set-for">
            <label class="js-set-for">от 181</label>
        </div>
        <div class="block__check">
            <input name="area_all" value="1" type="checkbox" class="js-checkbox js-set-for">
            <label class="js-set-for">Любая площадь</label>
        </div>
    </div>
    <div class="filter__block">
        <div class="block__title">Цена, руб.</div>
        <div class="block__check">
            <input name="price_2" value="1" type="checkbox" class="js-checkbox js-set-for">
            <label class="js-set-for">до 2 млн</label>
        </div>
        <div class="block__check">
            <input name="price_2_25" value="1" type="checkbox" class="js-checkbox js-set-for">
            <label class="js-set-for">от 2 до 2,5 млн</label>
        </div>
        <div class="block__check">
            <input name="price_25_35" value="1" type="checkbox" class="js-checkbox js-set-for">
            <label class="js-set-for">от 2,5 до 3,5 млн</label>
        </div>
        <div class="block__check">
            <input name="price_35" value="1" type="checkbox" class="js-checkbox js-set-for">
            <label class="js-set-for">от 3,5 млн</label>
        </div>
        <div class="block__check">
            <input name="price_all" value="1" type="checkbox" class="js-checkbox js-set-for">
            <label class="js-set-for">не имеет значения</label>
        </div>
    </div>
</form>