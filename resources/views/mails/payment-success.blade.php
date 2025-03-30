@component('mail::message')
    # Witaj, {{ $userName }}! 🎉

    Dziękujemy za wykupienie subskrypcji!
    Twoja płatność została pomyślnie zaksięgowana.

@component('mail::button', ['url' => config('app.url')])
    Przejdź do aplikacji
@endcomponent

    Dziękujemy za zaufanie!
    **Zespół {{ config('app.name') }}**
@endcomponent
