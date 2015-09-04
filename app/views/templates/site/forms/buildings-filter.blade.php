<form action="{{ URL::route('buildings.filter') }}" class="js-houses-filter" method="post">
    <div class="filter__block">
        <div class="block__title">Я хочу</div>
        <div class="block__check">
            <input name="house_build" value="1" type="checkbox" class="js-checkbox js-set-for">
            <label class="js-set-for">Уже готовый дом</label>
        </div>
        <div class="block__check">
            <input name="house_maket" value="1" type="checkbox" class="js-checkbox js-set-for">
            <label class="js-set-for">Построить дом</label>
        </div>
        <div class="block__check">
            <input name="house_all" value="1" type="checkbox" class="js-checkbox js-set-for">
            <label class="js-set-for">Все варианты</label>
        </div>
    </div>
    <div class="filter__block">
        <div class="block__title">Технология</div>
        <div class="block__check">
            <input name="technology" type="checkbox" class="js-checkbox js-set-for">
            <label class="js-set-for">Каркасные дома</label>
        </div>
        <div class="block__check">
            <input name="technology1" type="checkbox" class="js-checkbox js-set-for">
            <label class="js-set-for">Газобетонные блоки</label>
        </div>
        <div class="block__check">
            <input name="technology2" type="checkbox" class="js-checkbox js-set-for">
            <label class="js-set-for">Оцилиндрованное дерево</label>
        </div>
        <div class="block__check">
            <input name="technology3" type="checkbox" class="js-checkbox js-set-for">
            <label class="js-set-for">Все технологии</label>
        </div>
    </div>
    <div class="filter__block">
        <div class="block__title">Площадь дома, кв. м</div>
        <div class="block__check">
            <input name="area" type="checkbox" class="js-checkbox js-set-for">
            <label class="js-set-for">до 150</label>
        </div>
        <div class="block__check">
            <input name="area1" type="checkbox" class="js-checkbox js-set-for">
            <label class="js-set-for">151-180</label>
        </div>
        <div class="block__check">
            <input name="area2" type="checkbox" class="js-checkbox js-set-for">
            <label class="js-set-for">от 181</label>
        </div>
        <div class="block__check">
            <input name="area3" type="checkbox" class="js-checkbox js-set-for">
            <label class="js-set-for">Любая площадь</label>
        </div>
    </div>
    <div class="filter__block">
        <div class="block__title">Цена, руб.</div>
        <div class="block__check">
            <input name="price" type="checkbox" class="js-checkbox js-set-for">
            <label class="js-set-for">до 2 млн</label>
        </div>
        <div class="block__check">
            <input name="price1" type="checkbox" class="js-checkbox js-set-for">
            <label class="js-set-for">от 2 до 2,5 млн</label>
        </div>
        <div class="block__check">
            <input name="price2" type="checkbox" class="js-checkbox js-set-for">
            <label class="js-set-for">от 2,5 до 3,5 млн</label>
        </div>
        <div class="block__check">
            <input name="price3" type="checkbox" class="js-checkbox js-set-for">
            <label class="js-set-for">от 3,5 млн</label>
        </div>
        <div class="block__check">
            <input name="price4" type="checkbox" class="js-checkbox js-set-for">
            <label class="js-set-for">не имеет значения</label>
        </div>
    </div>
</form>