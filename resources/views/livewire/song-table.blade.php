<div>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Artist</th>
                <th>Pack</th>
            </tr>
        </thead>

        <tbody>
        @foreach ($songs as $song)
        <tr>
            <td>{{ $song->title }}</td>
            <td>{{ $song->artist->name }}</td>
            <td>{{ $song->pack->name }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
