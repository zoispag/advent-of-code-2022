<style>
    pre {
        font-size: xxx-large;
        font-family: monospace;
    }

    .on {
        color: #4a5568;
    }

    .off {
        color: #f7fafc;
    }
</style>

<pre>{{ (new \App\Actions\Challenges\DayTen())->puzzle2() }}</pre>

<script>
    const text = document.querySelector('pre')
    text.innerHTML = text.innerHTML
        .replaceAll('#', `<span class="on">#</span>`)
        .replaceAll('.', `<span class="off">.</span>`)
</script>
