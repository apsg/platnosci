<div
    x-data="{counter: {{ $counter }}}"
    x-init="window.setInterval(() => { if(counter > 0) counter = counter - 1;}, 1000)"
>
    <span x-text="`${(Math.floor(counter/3600))}`.padStart(2,'0')"></span>
    :
    <span x-text="`${(Math.floor(counter/60))}`.padStart(2,'0')"></span>
    :
    <span x-text="`${(counter%60)}`.padStart(2,'0')"></span>
</div>
