@extends('layouts.dashboard-frontend')

@section('page-content')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <!-- container-fluid -->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                        <h4 class="mb-sm-0 font-size-18">Reports & Analysis</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Reports & Analysis</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- main content -->
            <div>
                <div class='repAnal-div'>
                    <div class='repAnal-box'>
                        <p class='repAnal-badge'>Funnel Analytics</p>
                        <p class='fs-4 fw-bold'>Funnel Builder</p>
                        <div>
                            <div class='d-flex justify-content-center fw-bold text-secondary'>
                                <p class='text-center'>funnel count</p>
                                <i class="bi bi-graph-up-arrow ps-1"></i>
                            </div>
                            <p class='fs-3 fw-bolder text-center text-primary'>02</p>
                        </div>
                    </div>
                    <div class='repAnal-box'>
                        <p class='repAnal-badge'>Page Analytics</p>
                        <p class='fs-4 fw-bold'>Page Builder</p>
                        <div>
                            <div class='d-flex justify-content-center fw-bold text-secondary'>
                                <p class='text-center'>page count</p>
                                <i class="bi bi-graph-up-arrow ps-1"></i>
                            </div>
                            <p class='fs-3 fw-bolder text-center text-warning'>08</p>
                        </div>
                    </div>
                    <div class='repAnal-box'>
                        <p class='repAnal-badge'>Email Analytics</p>
                        <p class='fs-4 fw-bold'>Email Marketing</p>
                        <div>
                            <div class='d-flex justify-content-center fw-bold text-secondary'>
                                <p class='text-center'>email count</p>
                                <i class="bi bi-graph-up-arrow ps-1"></i>
                            </div>
                            <p class='fs-3 fw-bolder text-center text-success'>18</p>
                        </div>
                    </div>
                    <div class='repAnal-box'>
                        <p class='repAnal-badge'>Ecommerce</p>
                        <p class='fs-4 fw-bold'>Ecommerce Stores</p>
                        <div>
                            <div class='d-flex justify-content-center fw-bold text-secondary'>
                                <p class='text-center'>store count</p>
                                <i class="bi bi-graph-up-arrow ps-1"></i>
                            </div>
                            <p class='fs-3 fw-bolder text-center text-danger'>02</p>
                        </div>
                    </div>
                </div>
                <div class='product-numbers '>
                    <div class='transact-analysis'>
                        <p class='transact-badge'>Transaction Analysis</p>
                        <p class='fs-4 fw-bold'>Transaction Analysis</p>
                        <div id='transact'></div>
                    </div>
                    <div>
                      <div class='subscribe-analysis'>
                        <p class="default-badge">Subscription Detail</p>
                        <div>
                          <p class="text-center fw-bold fs-4 text-warning">STANDARD PLAN</p>
                        </div>
                        <div class="d-flex align-items-center">
                          <p>Status:</p>
                          <p><span class="ms-2 px-2 py-1 bg-success text-white fw-bold">Active</span></p>
                        </div>
                        <div>
                          <p class="mb-1">Duration:</p>
                          <p class="d-flex align-items-center">02-Feb-2023 <span><i class="bi bi-arrow-left-right px-1 text-danger"></i></span> 02-Mar-2023</p>
                        </div>
                      </div>
                      <div class='affiliate-analysis'>
                        <p class="default-badge">Affiliate Detail</p>
                        <div>
                          <p class="text-center fw-bold detail-fonting" >0</p>
                          <p class="text-center">No of Affiliate</p>
                        </div>
                        <div>
                          <p class="text-center fw-bold detail-fonting" >₦0.00</p>
                          <p class="text-center">Refferal Bonus</p>
                        </div>
                      </div>
                    </div>
                </div>
                <div class="product-details">
                  <div class="lms-details row align-items-end">
                    <p class="transact-badge">L.M.S Analysis</p>
                    <div class="col-lg-4">
                      <div class=" d-flex justify-content-center">
                        <img src="https://assets.siemens-energy.com/siemens/assets/api/uuid:2cdb2763-4749-4c71-8b58-ead09a6e210c/width:1125/quality:high/training-icons-purple-9-2020-05.png" alt="course" width="100%" class="course-img" />
                      </div>
                      <p class="text-center fw-bold">12 Courses in Store</p>
                    </div>
                    <div class="col-lg-4">
                      <div class="d-flex justify-content-center">
                        <img src="https://cdn3d.iconscout.com/3d/premium/thumb/books-4419998-3675926.png" alt="books" width="80%" class="course-img" />
                      </div>
                      <p class="text-center fw-bold">49 Unit Sold</p>
                    </div>
                    <div class="col-lg-4">
                      <div class="d-flex justify-content-center">
                        <img src="https://cdn.iconscout.com/icon/premium/png-256-thumb/book-medal-3836114-3186555.png" alt="books" width="70%" class="course-img">
                      </div>
                      <p class="text-center fw-bold my-0">Top Grossing Course</p>
                      <p class="text-sm text-center my-0">(Laravel Framework)</p>
                    </div>
                  </div>
                  <div class="ecommerce-details pt-lg-5 row">
                    <p class="transact-badge">Ecommerce Analysis</p>
                    <div class="col-lg-4">
                      <div class=" d-flex justify-content-center">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRZaigKX9qSt68HNKABqGtVQlhcLTnJksH0fA&usqp=CAU" alt="course" width="60%" class="course-imgs" />
                      </div>
                      <p class="text-center fw-bold mt-2">5 Shops</p>
                    </div>
                    <div class="col-lg-4">
                      <div class="d-flex justify-content-center">
                        <img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAoHCBQRFBcSEBEUGBcaFRcYFxoYGxIYHRoaHRoaGxcYGhUbHy8lHB0pHhcdKTYlNi49MzMzGyI5PjkxSiwyNDABCwsLEA4QHhISHjApIikyMjI1MjQyMjQ9NTIyNDIyMjI7NTIyMjQ5MjIyMjIyMjsyMjsyMjIyMjU0MjIyMjIyMv/AABEIAOEA4QMBIgACEQEDEQH/xAAcAAEAAgMBAQEAAAAAAAAAAAAAAQYCBQcEAwj/xABFEAACAQICBgUIBwYGAgMAAAABAgADEQQFBhIhMUFhBxMiUXEyNEJic4GRoRQjM1JysbKCkqKzwcIkNUNjdNEWUxVE8P/EABkBAQADAQEAAAAAAAAAAAAAAAACAwQBBf/EADERAAICAQIEBAQGAgMAAAAAAAABAhEDITEEEjJRIkFhcROBocFCUpGx0fAUMyNicv/aAAwDAQACEQMRAD8A7NERAEREAREQDESZg7AC5IAG+UzPtP6NG6YUCs27WvZB+16Xu2c5KEJTdJE4QlN0kXQm20yvZnpng6Fwa2uw9Gn29vcWHZB8TOWZtpBicXfr6pK/cXsp+6N/vuZq5qhwv5mbcfBL8b/QvuO6SahuMPh0UcGc6x/cWwH7xmixemWOq/8A2Co7kVF+dr/OV+Jpjhgtkao4Mcdkj2VM0xDbWxNc+NSoR8Na08zuzeUxPiSfzmESdJFqSWxkrkbiR4EieinmVdfJxFZfw1Kg/Jp5YnaQaTN7htLcdS3YlmHc4R/mwv8AObzBdJFZbCvQpuO9SyHxsdYH5SjRKpYYPdFcsEJbpHYct06wdawZzSbuqgKP3wSvzllp1AwBUgg7QQQQRyM/PM92WZvXwpvh6rptuVG1T4odh8bXlE+FX4WZcnBX0M75E5/kfSGj2TGr1bbtdblD+JdpX5jwl6oVlqKHRwykXBUggjvBG+ZJ45R3RhnjlB1JH3iRJkSAiIgCIiAIiIAiIgCIiARNRnue0cEutVbab6qjazHkO7mdgmu0s0rTBDUWz1iLqnBRwZ+4dw3n5jkuNxlTEO1Ws5d23k/IAbgB3DZNGLA56vY1YOGc9XsbXSHSivjSVZtSlfZTU7P223sflymiiJvjFRVI9OMVFVFCIiSJCIiAIiIAiIgCIiAIiIAm0yTPq+CbWoN2SbsjbVbv2cDzG3x3TVxItJqmcklJUztWjmk9HHLZTqVALtTJ2jmD6S8/iBLBPzzRqsjB0ZlZTdWUkEHvBE6jodpkuKtQxFlrW2NuWp4dzcuPDuGLNw/L4o7Hm5+F5PFHYu0SJMymMREQBERAEREAiVfTLSdcEmqlmrMOwp3KPvsO7uHE+BtsdI86TA0TWfafJReLMdw8OJPAAzieOxj4io9Wq2s7m7H8gBwAGwDuE0YMXO7exq4bDzu3sfOtWZ2Z3YszElmJuSTvJMwkRPRPUJiREAmJEQCYkRAJiRNnk2R4jGNq0UJUHtO1wo8W4nkLmRbSVs45JK2a2JuM80bxGC+1TWThUS7L4MbXU+I8LzTTsZKStCMlJWiYkROnSYkRAJiREAmAbbQbEbQRsIPAg8DIiAdV0G0r+kgYfEN9co7Lf+xRv/bHEcd/fa7T870qjIwdGKspDKw2EEbQQe+dl0O0hGOo3awqpYVFHyYD7pt7iCJg4jDy+KOx5nE4OXxR2LJEiTMpkEREAxtMXcAEk2AF9szlI6Sc66miMMh7dUHWtwpjyv3j2fDWkoQc5JInCDnJJFH0tz042uWBPVLdaQ5cX8WIv4WE0cRPWjFRVI9iMVFUhEROnRERAERCqSQACSTYAbSTwAHEwLE++DwlSu4p0KbO53Kov7ydwHM7Jasi0GqOOtxzdRSAuVJUMRxvfYg8dvITYYrSvDYJfo+U0VZjs17MVLbgb+VVb327iZS8tuoq39CiWe3UVb+hjl+htDCoMRmtZAB6AJC34AsO059UfOY43S+tiCMLlFAqtrAqq61vVXyaa8z8phgtFMVjW+k5nWZEtezEB9XeQF8mkvuvyG+enG6WYXAoaGV0kY8XN9S/eW8qoed7c5T1Pu/oijqf5n9EeLA6WYrAucNmNM1FAAIYqXCkcGBKuLd59/CezE6MYPMVNbLKqI3pUzcLfuZPKpnw2dw4yiY7GVK7tVrMWZt7Gw3bgANgAHCWHRPRjFV3WvTd6CDaKu5mHEIvpA957Pjuk5QUFzXT+hbKCguZOn9P0NHmWW1sM+piKbI3C+5uasNjCeOdbzbSfAAjCYpuuFtWo2qrqCOLlQBrX+6Nh7pXc30GDr12WVFqIRcIWB2epU3N4HbzMlDP+ZV+x2HEbcyr9ijRM69FkYq6MrKbMrAgg8wZhLzRYiIgCIiAJsMjzZ8HXWum2xs6/eQ+Uv8AUdxAmvicaTVM40mqZ+g8HiUrIlSm2srqGU94IuJ6JzfowznysG7d70r/AMaj463vadInlZIckqPIyY+STRMREgVmDG20zhOkeafS8TUrXupOrT/AuxPjtbxYzqmneY/R8FUINmf6pfFrhiOYUMfdOLzbwkN5G3hIbyJiRE2m0mJEQCZF568ry6piqi0aCgu195sABtJJ4AS9UdHsFlarXzBxUqHyVtddYbbJT9Ij7zbOOyVzyqOnn2K55VHTz7FZ0f0TxONs6rqUz/qODYj1F3v8hzlpfFZfk11pL1+JAsTdSwPEM+6mOQF91wd80OkGnGIxN6dG9Gnusp7bD1nG4ch4XMqgkOSc+rRdl9yHLKfVouy+5Yq+a4nNcQlCrWWmjtqqouEXeQSt+22zZc7yALXlnOIy/J+zTXr8SBYnslgeIL7qY5DbyM5vIA4DibAd5O4Ad87LCn6LsdliTpbLsbnPdJMRjT9a9kvsppcKO643seZ91p4sty6rin6uhTZ2423KO9mOxRLPkOg71B12ObqaQGsVJAcj1idiDx28hvntzLTGhhF+jZVSUAb6luzfiVB2u3rHZ+KR+Il4cav9iPOl4cav9j74XR/B5Wgr5i61Km9UA1luOCUztY+sdg5TQaRaZ18XdKd6VLdqqe0w9dxw9UbO+8ruKxT1XNSq7O53sxuT/wBDluEtWjugtbEWqYkmjS32I7bDkp8gczt5cYcYw8U3b/uyO8sY+Kbt/wB2RWMBgKmIcU6FNnc8FG4d5O5RzOydL0fyZMoQ4jG4qxYbUVm1L8l31H5293GePH6U4XLkOHyymjt6Tjaobddn31G99ufCUHMcwq4lzUxFRnY9+4DuVdyjkIall9I/VnHzZd9I/VnQaueZbmjGliabUmBtTqNqqeVqgJCn1W2bt/Cu59oViMLd6Y66lv1kHbUc0/qL+6VeWDINLcTgrIrdZTH+mxNgPUfenhtHKPhyh0P5M78OUOh/JlfB7pM6OcDgM6DPhz1OJtrMLAHxdAbOL+kDfvPCUnPMlq4Gp1dcLtGsrKbqy3tccR4ScMqk62fYlDKpOtn2NdEiJaWkxIiAenL8Y2HqpWTykcMOdt6+BFx753vBYha1NKqG6uisp5EXH5z89zq3RjmPWYZqLHtUnIH4Wuy/PWHumTi4WubsZOLhaUuxdoiJ59mA5j0rY29SjQB2KjVGHNjqr8ArfvTn8sGnWK63HVu5dVB+yov/ABFpX56+CPLjSPTwrlgkIiJcW2IiIFlr6NvPl9m/5CWbMNLaIxFbBY+iGpB9UMBrACwPbTfsv5Q28uMrPRt58vs6n5Ca7TPz7Ee0/tWZJY1PK0+xmlFTyNPsWLNtBldevyyqtRG2hCwPuSpx8Dt5yj16L02KVEZGU2KsCpHiDPZlGc18G+vhqhW/lKdqN+JOPjv5zo2S4/C50CuKwo6ymFYnbaxPouCGsSNqnZ4zrlPF1arv5nXOePq1X1KBkWj2IxzWorZAe1Ua4Re8X9I8h77S6qmX5ILk9direrri/cN1Nee8jvmx0xfG0aQXL6SrSC2Zqe11HctO1gtuIufC15yZEeo+qod3Ztw1mZmO/ZvJnFeXVul2X3OJvIrb07fybbP9JcRjj9a2ql7rTW4UdxP3zzPuAnwyXI6+NfUw6XAPac3CL+Ju/kNvKWrJNBVRevzRwiKNY09YCw/3Kl7DwB9/CZZ1p0lJfo+VoERRqh9UAAepTI+Z+HGd+J+HGv4O/E/DBfwe+hl2ByVRUxD9biLXUWBa/wDt079kesT7+Eqekel2Ixt1J6ul9xSe0PXb0vDdy4zQV6zOxd3ZmY3ZmJJJ5kzCThhSfNLVko40nzS1YiJYNH9EsTjbMF6ul/7GB2j1V3t47ucslJRVsslNRVs0KqSQFBJJsAASSeAAG8y5ZHoG9QdbjX6mmBrFeyHI9YnYg8dvITbNisvyUFaS9fiQLE3BYHiGfdTHqgX3bDvlMzzSPE44/XPZL3FNLhR3XHpHmfdaU808nTou5Vzzntou5cMRpbhcEFw2WUka7KGfbq7TbWv5VVud7czunl6WPtqHs3/UJR8L9on41/UJeOlf7ah7N/1CQWNQyRr1IKChNV6lCiImw1WIiIFiW7o0xvV4zUJ2VabLb1l7an4Bh75UZ78hxPU4qhU7qqX8CwDfImVZI80GiGRc0Wjv8TG8ieTR5dHAM3qa+IrseNeqfcXa3ynimVR9Zi3eSfibzGe0lSPSTERE6dsREQLLZ0a+fL7Op/Sa7TLz7E+0/tWbDo18/X2dT8hNdpmf8difaf2rM6/3P2+5Sn/yP2NLL90T/a1/Z0/1NKCDL90Tfa4j2dP82kuI/wBbO5X4WanLNLsTgqjoG6ykKj9hydg1j5D718No5Tp2T9RWRcZSooj1kB1iqBzv2Mw3/GcPxv2lT2j/AKjL9m7lckw7KSCDSIIJBB1jYgjcZRmxJ8taNuirJBaV5mm03p5hr3xu2nrdg079UO6w3hvxbd9jaVSXTItPHQdVjl6+mRYtYFwO5gdjjx28zNhjtEMNjlNfKqyKeKEnUv8Adt5VI8rW5CWxn8PwzVeq2LIz5NJI53NhlGT18Y2rh6ZaxszHYi/ibcPDfyluyvQZKC9fmtVFUberDWHg7jefVX4mYZvp2tNeoyyktNALCoVA96U7WHi23lOvM5OoK/XyOvK3pHU9tHIcDlairj6i1au9VtcX9Sl6W30m2eE0WkOnGIxN0o3o0t1lPbYes43DkPiZV61d6jF6jM7ttLMSxPiTMIjhV809WFBXctWIiSiliFUEkkAAbSSdgAHEy8ts+mG+0T8a/qEvHSx9tQ9k/wCoSn1MFUoVkSvTZG1kbVbuLbDzGw/Ay4dLP21D2T/qEzy1yRr1KZPxr5lCiImgusREQLEMSBcb+HjEQLO2f+QDlE5P/wDKN3mJk/xkZ/hGsdbEjuJHwmM9WbU9XEVl+7WqL8HYf0nkmtaossmJETosmJEQLLZ0aefr7Op+QnuoIDn5DAEdc5294okg+4gH3Tw9Gnn6+zqfkJsML/n59q/8hpjydcv/ACUyfifsafT9AuYV9UAX6s7O800JM3PRPUAr11JFzTSw4mxN9nK4+M0/SH/mFbwp/wAtJXabsjBkYqwN1ZSQQe8EbQZYoc+JR9ESrmjXobfSPI8RhKjNWQ6jOxV17Sm5JA1uB27jYy1Zz/keH8aX5meTI9P3UdTmCCqhFi4Clresm5h8D4zZaZ5jhHy5aWDq0iuumoiMLgAkkdXvUDuI2bJVJz5oxkvPcg3K0mvM5rN5oXUZcdQ1WYaz6rWJGsuqeybbxymim60N8+w3tP7WmrJ0P2ZbJ+Fm16TKrHG6pYlVppqqSbKTe5A3AmVGWvpL8/b2VP8ArKnI4eiPscxvwomJES0nZM9uSedYb/k0P5iTwz3ZJ51hv+TQ/mJIz2ZxstnSV5/Q9jS/mvPp0tfbUPZP+oT59Jnn9D2VL+a8+nS19tQ9k/6hMmLeHsymD1j8yhRIibS+yYkRAsmLyJDnYfCDlmw/+PbuidU/8a9URM3+Qiv4pzrTjDdVj644MwcftKrH5kzQy+dLGC1a9KuBsemUPijXF+ZFT+GUKWYJc2NM7B3FExIiWkiYkRALZ0aefr7Op+Qmxwv+fn2tT+Q013Rn5+vs6n5CZZhmS4XOamIZSypWOsFtezUtQ2vxGtf3TJNXkkl+UqfU/Y83SF/mNbwp/wAtJW507NtHsPnGti8DiB1hC6wN9UkKAodPKpmwG23uO+c9zXKq+EfUxFNkPAnarc1cbG//AF5ZgyRcVHzXkdhJVR45ERLywmbrQ3z7De0/taaSbrQzz/De0/taQydD9mclszZdJnn7eyp/1lUlr6TPP29lT/rKnOYeiPsch0omJESwkTPbkfnWG/5ND+Yk8Mu2iehOId6eJxH1KU6iVAGHbfVYMOz6A2bzt5cZVlnGMdWclJJan16TPP6HsqX815n0tfbUPZv+oTwaeZjSxGOptQqB1VKaMy7V1hUYkBtx2EbRsnv6WvtqHs3/AFCZ8apwvsyqO6KFEiJtLiYkRAJnsybDdbiKNP79Wmp8NYa3yvPFLV0bYLrccrkbKaM58baij+O/7MhklywbOSdJs7NaJlE8Yx2VTpGy7r8E7AdqkRVHgtw/8BY+6cXn6QqoGBVgCCCCDxB3ifnzPMtbCYiphzfsuQpPFDtQ/uke+83cHPeJdilpR4omMTaXWZRMYgWbPIc3fBV1xFMKxUEENexUixFxu8eUv4OXZ4No6nFW9UObc/Jqr8wPuzlsAyrJiUnzJ0+5GUU9fMs+a6PY3Kn65GbVXdWpXsB/uL6I7wbrzM3+VadUcSn0fNaKlTYa4XWQ9xZN6nmPlNZo7p/Xw4FPEg16e65P1ij8R8vwO3nNzitF8DmiGvllVKT72UCy3PB6e9DzGzfsMon2yL5og/8At+pr9JNCKaUmxeArBqSo1QqW1rKBclHHlAAbjt2bzulFmyzLB4vA62HrdZTRt6hn6upbiLHVbd47rzVzRhTS1dk47bmU3ehnn+G9p/a00U3ehfn+G9p/a07k6H7M7J6M2fSb5+3sqf8AWVOWzpP8/b2VP+6VGRw9EfY5B+FGV5vNH9FcTjiGppqU+NR7heeqN7nw2d5E0+ErBHR2UOFdWKtucAglTyNre+XTH6Z4vHMMNl9FqYItZO05H4wAKS8/mN0ZJSWkf1fkJN+Rt9XLckFz9figPVZweQ8mkPnbvmjqYzMc7YpTXUo3sQCy0x+N97nlt/CJscu0KoYRPpOb11331NY6usdtmbyqjeqOflTx530gMV6jLqYo0wNUPqgNb1UGxB8T4TNFW7jq+72K1vpq+5tKeVZfkwFTFuK2ItrKtgTf1KV7Lt9Jj7xKbpRpC+YVRUZAiopVFBuQL3JZuJP9Jpajs5LOxZibszEsSe8sdpMxmmGKnzSdsmo07e5lExiWk7MomMQLMp1bopy7Uw74hhtqPqr+FLj9Rb4TluFw71XSmgu7OqKObGw922foLKsCuGo06CeSiKo52G0nmTt98ycXOo8vcqyy0o90RE82jOROd9KmR69NcYg7SAJUtxQnst+yxPuY906JPliKK1EZHAZWUqwO4gixB9xlmObhJSRKLp2fm28Xm10nyV8DiHotcp5VNj6SHdt7xuPMcxNTeeupJq0aLJvF5F4vJCybxeReLwLJvPvhMU9FxUouyONzKSCOXMctxnnvF5wWdGyjT2nXX6PmtJGVtnWBbqeb0+B9ZfgJhnOgC1F+kZXVV0YawQsGuP8AbqXsfBvjOeXmyybPcRgn18NUK3N2Q9pH/En9RY85Q8Ti7g69PIhVdJ48RRem5SojI6mzKwKkeIM2+hZ/x+G9p/a0uWH0iy/N0WjmFNaVXcrE2F/Urejc+i2w7u1Pjg9Bq2Dx1CrTbraIqAltgdBYjtLxG0bR8BIyzLlcZqnTDnpTNN0nn/Ht7Kn/AHSoqCSAoJJNgBckngABvM6bpVojiMfmBZAEpCnTBqN3i9wqDax28hzh8ZluSApRXr8UBYm4Zge5qltWkPVAv3g75yGZKCjHV0FOkkjUZBoBUqDrse3UUwNYqdUOR3sTsQeO3kJssfpjhcAhw+U0UY8ahvqX+9reVVPO9uZ3Sm5/pNicefr3tTvdaaXVR3XHpHmfdaae8l8Jz1m/l5Cr3PZmOZVcS/WYio1R+BO4DuVRsUchPJeReLzQqWiJ2TeLyLxedFk3i8i8XgWTeLyLz15Tl74qsmHpDtM1r8FG9nbkBc/LjONpasWXfosyTXqNjHXspdKd+Lkdth4KbftHunVp4spwCYWjToUhZUXVHeeJY8ySSeZntnkZcnPKzPKXM7EmIlZEREQCuaZaOrj6BQWFVLtSY8G4qT91tx9x4ThWIpPTdkqKVdWKsp3gjYQZ+l5ROkDQ76Wv0jDKOvUdpd3WqBu/GOB47jwI1cPm5fDLYnGVaHH7xeYnZcEEEEgg7CCNhBHAyLz0CyzO8XmF4vAszvF5heLwLM7xeYXi8CzO8sujemmJwNk1uspD/Tcnsj1H3r4bRylXvF5GUVJUzjdlx0j0+xOLvTo3oUzsIU3du/WqbLDkLcyZUbzC8XnIxjFVFBaGd4vMLxeTO2Z3i8wvF4Fmd4vMLxeBZneLzC8FoFn0HL5f9Ts/R7ox9CpdbWX6+oBrD7i7wnjxPOw4TS9HOhxXVxuLSx2NRpsNq91RwfS+6OG/fa3TZg4jPfhiQlLyJiImQrEREAREQBERAKBpzoKMXfEYQKtfey7AtX3+i/Pcdx7xx+tTZGZHVlZSQysCCpG8EHcZ+npV9LdDqGYrrH6usBZaigE8ldfSX5jgRNOHiOXwy2JJnBtaNabHPshxGAqamJpkAnsOLmm/4X7+R2jumr1puUk1aO2Z60a0w1o1p2xZnrRrTDWjWixZnrRrTDWjWixZnrRrTDWjWixZnrRrTDWjWixZnrRrTDWjWixZnrRrTDWnsyrLK2LcUsNTZ3423KPvO25V5n3XnG6FnnB/6HjwE6loLoEVK4rHrt2NTosPJO8PUH3u5eHHbsG50P0DpYG1auRVxHBrdhPwKePrHb3W3S6zFm4i/DE42JMRMpEREQBERAEREAREQBERAPNjcHTro1OsiujCzKwDA+4zmOknRZvqZc/PqahPwSodvub94Tq0ScMko7A/MOZZfWwz6mJo1KbcA4tf8LbmHMEieTWn6hxuCp10NOtTSoh3q6hgfcZSM36LcJVu2HapQY3NgesS/wCBjcDkGAmqHEp9WhyjiutGtLvmXRfj6VzS6qsvDUbUY+KPYD94ys43R/GUPtcJXXnqOy/vqCvzl8ckZbMGu1o1piXANiQDxHH4SbyQJ1o1pjILjdcfEQDPWjWnuweTYqsbUcLXfmtNyP3rW+cseXdGuY1rF0p0V4mo4JtyVNbbyNpFzit2Cna0++Ew1Ss4SjTeo53Kisx8bDhznW8p6KMMlji6z1jxVfqk/hJb+IS9ZbldDCr1eGopTXuRQt+ZI2k8zKJ8Sl06ijlejnRdVqWqZg/VLv6tCrOeTPtVPdc8xOp5XlVHCUxSw1JaaDgvE95Y7WPMm890mZZ5JT3OiIiQAiIgCIiAIiIAiIgCIiAIiIAiIgCIicYEiInQVjSzd7jOLZ55Z8YibcOxxnnyryh7p2TQ70fCTElmOIucSYmAkIiJwCIidAiIgCIiAIiIAiIgH//Z" alt="books" width="60%" class="course-imgs" />
                      </div>
                      <p class="text-center fw-bold mt-2">45 Products</p>
                    </div>
                    <div class="col-lg-4">
                      <div class="d-flex justify-content-center">
                        <img src="data:image/jpeg;base64,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"  alt="books" width="60%" class="course-imgs" >
                      </div>
                      <p class="text-center fw-bold mb-0">Top Grossing Product</p>
                      <p class="text-sm my-0 text-center">(Funnel Case)</p>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page-content -->
</div>
<script>
     var options = {
          series: [{
          name: 'Servings',
          data: [44, 55, 41, 67, 22, 43, 21, 33, 45, 31, 87, 65, 35]
        }],
          annotations: {
          points: [{
            x: 'Bananas',
            seriesIndex: 0,
            label: {
              borderColor: '#775DD0',
              offsetY: 0,
              style: {
                color: '#fff',
                background: '#775DD0',
              },
              text: 'Bananas are good',
            }
          }]
        },
        chart: {
          height: 350,
          type: 'bar',
        },
        plotOptions: {
          bar: {
            borderRadius: 10,
            columnWidth: '50%',
          }
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          width: 2
        },
        
        grid: {
          row: {
            colors: ['#fff', '#f2f2f2']
          }
        },
        xaxis: {
          labels: {
            rotate: -45
          },
          categories: ['Course Sales', 'Email Auto..', 'Strawberries', 'Tangerines', 'Papayas'
          ],
          tickPlacement: 'on'
        },
        yaxis: {
          title: {
            text: 'Servings',
          },
        },
        fill: {
          type: 'gradient',
          gradient: {
            shade: 'light',
            type: "horizontal",
            shadeIntensity: 0.25,
            gradientToColors: undefined,
            inverseColors: true,
            opacityFrom: 0.85,
            opacityTo: 0.85,
            stops: [50, 0, 100]
          },
        }
        };

        var chart = new ApexCharts(document.querySelector("#transact"), options);
        chart.render();
</script>
<!-- END layout-wrapper -->
@endsection