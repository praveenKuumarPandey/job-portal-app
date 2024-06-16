<nav {{$attributes}}>
    <ul class="flex space-x-4 text-slate-500">
        <li>
            <a href="/"> Home</a>
        </li>

        @foreach ($links as $linkItemLable => $linkItemValue)
        <li>-></li>
        <li>
            <a href="{{ $linkItemValue }}"> {{$linkItemLable}}</a>
        </li>
        @endforeach

    </ul>
</nav>