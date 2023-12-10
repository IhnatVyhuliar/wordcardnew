<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="robots" content="index, follow">
    <meta name="keywords" content="wordcard, languages, flashcards, words, card, word, card word, cards, studying, folders, flash, every, any, way to learn, learn, learning languages, english, polish, deutsch, german, ukrainian, chinese, korean, definition, translation">
    <meta name='author' content="Ihnat Vyhuliar">
    <meta name="description" content="Platform for studying every language">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">

    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />    
    <link rel="shortcut icon" href="{{Storage::url('public/cards/wordcard.png')}}">
    <title>WordCard</title>
</head>

<body>
    @include('layouts.navigation2')

    <div class="w-11/12 h-auto m-auto p-4">
        <div class="flex space-x-3 mt-4 space-y-4 flex-wrap">
            <div class="element w-[50%] max-md:w-[90%]">
                <h2 class="text-5xl">WordCard- your way to learn languages</h2>
            </div>

            <div class="element container w-[500px] h-[300px] border-4 border-gray-200 rounded-xl mt-4 ml-5 flex flex-col p-2 overflow-y-auto ">
                <div class="word flex justify-between">
                    <div class="word "> Success</div>
                    <div class="edit flex space-x-3">    
                        <div class="favorite">

                                    <input type="hidden" name="id" value="1">
                                    <input type="hidden" name="folder_id" value="1">
                                    <input type="hidden" name="page" value="cards">
                                    <button type="submit">

                                        <svg width="20" height="20" viewBox="0 0 23 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.8459 1.87012L14.9359 8.13012L21.8459 9.14012L16.8459 14.0101L18.0259 20.8901L11.8459 17.6401L5.66595 20.8901L6.84595 14.0101L1.84595 9.14012L8.75595 8.13012L11.8459 1.87012Z" stroke="orange" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        
                                        
                                    </button>

        
                            
                                
                        </div>
                       
                        <div class="edit">

                            <svg width="20" height="20" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.5525 3.56224H3.55249C3.02206 3.56224 2.51335 3.77295 2.13828 4.14803C1.7632 4.5231 1.55249 5.03181 1.55249 5.56224V19.5622C1.55249 20.0927 1.7632 20.6014 2.13828 20.9765C2.51335 21.3515 3.02206 21.5622 3.55249 21.5622H17.5525C18.0829 21.5622 18.5916 21.3515 18.9667 20.9765C19.3418 20.6014 19.5525 20.0927 19.5525 19.5622V12.5622" stroke="#1D4ED8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M18.0525 2.06224C18.4503 1.66441 18.9899 1.44092 19.5525 1.44092C20.1151 1.44092 20.6547 1.66441 21.0525 2.06224C21.4503 2.46006 21.6738 2.99963 21.6738 3.56224C21.6738 4.12485 21.4503 4.66441 21.0525 5.06224L11.5525 14.5622L7.55249 15.5622L8.55249 11.5622L18.0525 2.06224Z" stroke="#1D4ED8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            
        
                    </div>
                        
        
                  

                        <div class="delete ">
                          
                                <button type="submit">
                                    <svg width="20" height="20" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.25 4.5H3.75H15.75" stroke="#DF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M14.25 4.5V15C14.25 15.3978 14.092 15.7794 13.8107 16.0607C13.5294 16.342 13.1478 16.5 12.75 16.5H5.25C4.85218 16.5 4.47064 16.342 4.18934 16.0607C3.90804 15.7794 3.75 15.3978 3.75 15V4.5M6 4.5V3C6 2.60218 6.15804 2.22064 6.43934 1.93934C6.72064 1.65804 7.10218 1.5 7.5 1.5H10.5C10.8978 1.5 11.2794 1.65804 11.5607 1.93934C11.842 2.22064 12 2.60218 12 3V4.5" stroke="#DF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M7.5 8.25V12.75" stroke="#DF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M10.5 8.25V12.75" stroke="#DF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                </button>

                        </div>

                    
                    
        
                </div>
                </div>
               
                
                <div class="word flex justify-end">
                    <img src="{{Storage::url('public/cards/mainlogo.png')}}"  class="w-40 h-18 rounded mt-2">
                </div>
                
                <div class="flex mt-[25px]">
                    <p id='demo_def1' class="text-lg"  >WordCard</p>     
                    
                    
                </div>
                
                <div class="flex justify-between mt-[50px]">
                    <p id='demo_trans1' class="text-lg" >Languages is everything</p>   
                    
                    
                </div>
                <div class="flex justify-end items-end mt-[30px]">
                    <span>100%</span>
                </div>
        
            </div>
            
           </div>
        
        
    </div>
</body>
</html>