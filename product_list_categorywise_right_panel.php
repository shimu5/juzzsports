<div class="col-right sidebar col-xs-12 col-sm-3">
    <div class="block block-layered-nav first">
        <div class="block-title"> <strong><span>Shop By</span></strong> <span class="toggle"></span></div>
        <div class="block-content">
            <p class="block-subtitle">Shopping Options</p>
            <dl id="narrow-by-list">
                <dt class="odd">Price</dt>
                <dd class="odd">
                    <ol>
                        <li> <a href="#"><span class="price">$10.00</span> - <span class="price">$19.99</span></a> (1) </li>
                        <li> <a href="#"><span class="price">$20.00</span> - <span class="price">$29.99</span></a> (2) </li>
                        <li> <a href="#"><span class="price">$30.00</span> - <span class="price">$39.99</span></a> (2) </li>
                        <li> <a href="#"><span class="price">$40.00</span> and above</a> (1) </li>
                    </ol>
                </dd>
                <dt class="last even">Manufacturer</dt>
                <dd class="last even">
                    <ol>
                        <li> <a href="#">Equal</a> (1) </li>
                        <li> <a href="#">Junee Fashion </a> (1) </li>
                        <li> <a href="#">Luxhair </a> (2) </li>
                        <li> <a href="#">SoulTress </a> (1) </li>
                        <li> <a href="#">Wigpro Collection </a> (1) </li>
                    </ol>
                </dd>
            </dl>
        </div>
    </div>
    <div class="block block-cart">
        <div class="block-title"> <strong><span>My Cart</span></strong> <span class="toggle"></span></div>
        <div class="block-content">
            <p class="empty">You have no items in your shopping cart.</p>
        </div>
    </div>
    <div class="block block-list block-compare">
        <div class="block-title"> <strong><span>Compare Products </span></strong> <span class="toggle"></span></div>
        <div class="block-content">
            <p class="empty">You have no items to compare.</p>
        </div>
    </div>
    <div class="block block-tags">
        <div class="block-title"> <strong><span>Popular Tags</span></strong> <span class="toggle"></span></div>
        <div class="block-content">
            <ul class="tags-list">
                <li><a style="font-size:145%;" href="#">bundles</a></li>
                <li><a style="font-size:145%;" href="#">collection</a></li>
                <li><a style="font-size:145%;" href="#">conditioners</a></li>
                <li><a style="font-size:110%;" href="#">demanding</a></li>
                <li><a style="font-size:110%;" href="#">emphasize</a></li>
                <li><a style="font-size:110%;" href="#">experiment</a></li>
                <li><a style="font-size:75%;" href="#">professionally</a></li>
                <li><a style="font-size:75%;" href="#">shampoos</a></li>
            </ul>
            <div class="actions"> <a href="#">View All Tags</a> </div>
        </div>
    </div>
    <script type="text/javascript">
        //&lt;![CDATA[
        function validatePollAnswerIsSelected()
        {
            var options = $$('input.poll_vote');
            for( i in options ) {
                if( options[i].checked == true ) {
                    return true;
                }
            }
            return false;
        }
        //]]&gt;
    </script>
    <div class="block block-poll last_block">
        <div class="block-title"> <strong><span>Community Poll</span></strong> <span class="toggle"></span></div>
        <form onsubmit="return validatePollAnswerIsSelected();" method="post" action="#" id="pollForm">
            <div class="block-content">
                <p class="block-subtitle">What is the main reason for you to purchase products online?</p>
                <ul id="poll-answers">
                    <li class="odd">
                        <input type="radio" value="1" id="vote_1" class="radio poll_vote" name="vote">
                            <span class="label">
                            <label for="vote_1">More convenient shipping and delivery</label>
                            </span> </li>
                    <li class="even">
                        <input type="radio" value="2" id="vote_2" class="radio poll_vote" name="vote">
                            <span class="label">
                            <label for="vote_2">Lower price</label>
                            </span> </li>
                    <li class="odd">
                        <input type="radio" value="3" id="vote_3" class="radio poll_vote" name="vote">
                            <span class="label">
                            <label for="vote_3">Bigger choice</label>
                            </span> </li>
                    <li class="even">
                        <input type="radio" value="4" id="vote_4" class="radio poll_vote" name="vote">
                            <span class="label">
                            <label for="vote_4">Centralized product search procedure (without having to leave your home)</label>
                            </span> </li>
                    <li class="odd">
                        <input type="radio" value="5" id="vote_5" class="radio poll_vote" name="vote">
                            <span class="label">
                            <label for="vote_5">Payments security</label>
                            </span> </li>
                    <li class="even">
                        <input type="radio" value="6" id="vote_6" class="radio poll_vote" name="vote">
                            <span class="label">
                            <label for="vote_6">30-day Money Back Guarantee</label>
                            </span> </li>
                    <li class="last odd">
                        <input type="radio" value="7" id="vote_7" class="radio poll_vote" name="vote">
                            <span class="label">
                            <label for="vote_7">Other.</label>
                            </span> </li>
                </ul>
                
                <div class="actions">
                    <button class="button" title="Vote" type="submit"><span><span>Vote</span></span></button>
                </div>
            </div>
        </form>
    </div>
</div>