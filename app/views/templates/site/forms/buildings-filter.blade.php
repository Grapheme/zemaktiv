<form action="{{ URL::route('buildings.filter') }}" class="js-houses-filter" method="post">
    <div class="filter__block">
        <div class="block__title">Я хочу</div>
        <div class="block__check">
            <input name="house_build" value="1" type="checkbox" class="js-checkbox js-set-for">
            <label class="js-set-for">Уже готовый дом</label>
        </div>
        <div class="block__check">
            <input name="house_layout" value="1" type="checkbox" class="js-checkbox default js-set-for">
            <label class="js-set-for">Построить дом</label>
        </div>
        <div class="block__check">
            <input name="house_all" value="1" type="checkbox" class="js-checkbox js-set-for">
            <label class="js-set-for">Все варианты</label>
        </div>
    </div>
    <div class="filter__block">
        <div class="block__title">Технология</div>
        <?php
            $index = 1;
            $materials = LayoutHomesController::$materials;
            $materials_count = count($materials);
        ?>
        @foreach(LayoutHomesController::$materials as $material)
            <div class="block__check">
                <input name="technology_{{ $index }}" value="1" type="checkbox" class="js-checkbox {{ $index == $materials_count ? 'default':'' }} js-set-for">
                <label class="js-set-for">{{ $material }}</label>
            </div>
            <?php $index++;?>
        @endforeach
        <div class="block__check">
            <input name="technology_all" value="1" type="checkbox" class="js-checkbox js-set-for">
            <label class="js-set-for">Любая технология</label>
        </div>
    </div>
    <div class="filter__block">
        <div class="block__title">Площадь дома, кв. м</div>
        <div class="block__check">
            <input name="area_150" value="1" type="checkbox" class="js-checkbox js-set-for">
            <label class="js-set-for">до 150</label>
        </div>
        <div class="block__check">
            <input name="area_150_180" value="1" type="checkbox" class="js-checkbox js-set-for">
            <label class="js-set-for">150-180</label>
        </div>
        <div class="block__check">
            <input name="area_181" value="1" type="checkbox" class="js-checkbox default js-set-for">
            <label class="js-set-for">от 181</label>
        </div>
        <div class="block__check">
            <input name="area_all" value="1"type="checkbox" class="js-checkbox js-set-for">
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
            <input name="price_2_3" value="1" type="checkbox" class="js-checkbox js-set-for">
            <label class="js-set-for">от 2 до 3 млн</label>
        </div>
        <div class="block__check">
            <input name="price_3_5" value="1" type="checkbox" class="js-checkbox js-set-for">
            <label class="js-set-for">от 3 до 5 млн</label>
        </div>
        <div class="block__check">
            <input name="price_5" value="1" type="checkbox" class="js-checkbox js-set-for">
            <label class="js-set-for">от 5 млн</label>
        </div>
        <div class="block__check">
            <input name="price_all" value="1" type="checkbox" class="js-checkbox default js-set-for">
            <label class="js-set-for">Не имеет значения</label>
        </div>
    </div>
</form>