<section class="py-16">
  <div class="max-w-6xl mx-auto px-6">
   <div class="">
        <span class="flex items-center ">
            <span class="h-px flex-1 bg-gradient-to-r from-transparent to-primary-500"></span>
            <span class="shrink-0 px-4 text-white text-4xl font-bold">Experience</span>
            <span class="h-px flex-1 bg-gradient-to-l from-transparent to-primary-500"></span>
        </span>
   </div>

  <div class="grid md:grid-cols-2 my-10 bg-gray-500/10 border border-gray-500/30 rounded-lg">

   {{-- Salient --}}
    <x-experience-card 
      period="Apr 2025 - Present" 
      role="Back-End Engineer" 
      company="Salient Software Solutions"
      route="https://salientsolutions.tech" 
      location="Asaba, Delta State"  
      description="Contributed to the development and enhancement of two major company projects: 
          AgoPay, a platform for simple and secure installment payments, and 
          Agogo, an e-commerce platform offering flexible purchase options. ">

        <x-key-responsibility-card> Integrated Slack for real-time notifications. </x-key-responsibility-card>
        <x-key-responsibility-card> Built an invitation system managed by agents. </x-key-responsibility-card>
        <x-key-responsibility-card> Developed KYC (Know Your Customer) processes for platform users. </x-key-responsibility-card>
        <x-key-responsibility-card> Integrated third-party APIs for payment and KYC services. </x-key-responsibility-card>
        <x-key-responsibility-card> Enabled multiple payment gateway integrations to allow easy switching during downtimes. </x-key-responsibility-card>
        <x-key-responsibility-card> Optimized database queries to improve performance. </x-key-responsibility-card>
        <x-key-responsibility-card> Tutored interns on the basics of web development and backend technologies using PHP and Laravel. </x-key-responsibility-card>


        <x-slot:projects>
          <x-tag route="https://www.agopay.africa/">Agopay</x-tag>
          <x-tag route="https://agogo-africa.com/">Agogo</x-tag>
        </x-slot:projects>

        <x-slot:technologies>
          <x-tag>Insomnia</x-tag>
          <x-tag>PHP</x-tag>
          <x-tag>Laravel</x-tag>
          <x-tag>MySQL</x-tag>
          <x-tag>QOREID API</x-tag>
          <x-tag>PayStack/FlutterWave API</x-tag>
        </x-slot:technologies>

    </x-experience-card>

 
    {{-- Gygital --}}
     <x-experience-card 
      period="Aug 2024 - Apr 2025" 
      role="Full-Stack Web Developer" 
      company="Gygital" 
      route="https://gygital.com/" 
      location="Asaba, Delta State"  
      description="Collaborated with the team lead to deliver full-stack 
        solutions for company and clients using modern frameworks and best practices.">

        <x-key-responsibility-card> Built a software-engineering training platform.</x-key-responsibility-card>
        <x-key-responsibility-card> Developed a startup-support and tech-solutions ecosystem platform. </x-key-responsibility-card>
        <x-key-responsibility-card> Built a strategic consulting platform offering grant management, business registration, and digital-solution services. </x-key-responsibility-card>
        <x-key-responsibility-card> Converted a multi-vendor e-commerce platform from separate Laravel backend and Vue frontend projects into a unified monolithic Laravel and Livewire application. </x-key-responsibility-card>
        <x-key-responsibility-card> Integrated payment-system APIs for seamless online transactions. </x-key-responsibility-card>

        <x-slot:projects>
          <x-tag route="https://britonkay.ng/">BritonKay</x-tag>
          <x-tag route="https://allsyntax.gygital.com/">AllSyntax</x-tag>
          <x-tag route="https://atriomtechnologies.com/">Atriom Technologies</x-tag>
          <x-tag route="https://mothompsonconsult.com/">Mo Thompson Consulting</x-tag>
        </x-slot:projects>

        <x-slot:technologies>
          <x-tag>PHP</x-tag>
          <x-tag>Laravel</x-tag>
          <x-tag>Livewire</x-tag>
          <x-tag>Blade</x-tag>
          <x-tag>MySQL</x-tag>
          <x-tag>PayStack</x-tag>
        </x-slot:technologies>

    </x-experience-card>
    
  </div>
  </div>
</section>