<section class="py-16">
  <div class="max-w-6xl mx-auto px-6">
   <div class="">
        <span class="flex items-center ">
            <span class="h-px flex-1 bg-gradient-to-r from-transparent to-primary-500"></span>
            <span class="shrink-0 px-4 text-white text-4xl font-bold">Experience</span>
            <span class="h-px flex-1 bg-gradient-to-l from-transparent to-primary-500"></span>
        </span>
   </div>

  <div class="grid md:grid-cols-2 border border-primary-500 my-10">

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
          <x-key-projects-card route="https://www.agopay.africa/">Agopay</x-key-projects-card>
          <x-key-projects-card route="https://agogo-africa.com/">Agogo</x-key-projects-card>
        </x-slot:projects>

        <x-slot:technologies>
          <x-key-technologies-card >Insomnia</x-key-technologies-card>
          <x-key-technologies-card >PHP</x-key-technologies-card>
          <x-key-technologies-card >Laravel</x-key-technologies-card>
          <x-key-technologies-card >MySQL</x-key-technologies-card>
          <x-key-technologies-card >QOREID API</x-key-technologies-card>
          <x-key-technologies-card >PayStack/FlutterWave API</x-key-technologies-card>
        </x-slot:technologies>

    </x-experience-card>

 
    {{-- Gygital --}}
     <x-experience-card 
      period="Aug 2024 - Apr 2025" 
      role="Full-Stack Web Developer" 
      company="Gygital" 
      route="https://gygital.com/" 
      location="Asaba, Delta State"  
      description=" Developed and deployed production-grade web applications with a focus on performance, 
        scalability, and user experience. Collaborated with the team lead to deliver full-stack 
        solutions using modern frameworks and best practices, while mentoring an intern in core 
        web development technologies — HTML, CSS, Tailwind, JavaScript, and PHP. ">

        <x-key-responsibility-card> Integrated Slack for real-time notifications. </x-key-responsibility-card>
        <x-key-responsibility-card> Built an invitation system managed by agents. </x-key-responsibility-card>
        <x-key-responsibility-card> Developed KYC (Know Your Customer) implementation for platform users. </x-key-responsibility-card>
        <x-key-responsibility-card> Integrated third-party APIs for the payment and KYC systems. </x-key-responsibility-card>
        <x-key-responsibility-card> Enabled multiple payment gateway integration to allow easy switching during downtimes.  </x-key-responsibility-card>

        <x-slot:projects>
          <x-key-projects-card route="https://allsyntax.gygital.com/">AllSyntax</x-key-projects-card>
          <x-key-projects-card route="https://atriomtechnologies.com/">Atriom Technologies</x-key-projects-card>
          <x-key-projects-card route="https://mothompsonconsult.com/">Mo Thompson Consulting</x-key-projects-card>
        </x-slot:projects>

    </x-experience-card>
    
  </div>
  </div>
</section>