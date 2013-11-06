title: "Image Attachments as files in Apple Mail"

published: 2013-05-09T12:00:00+3:00

type: linked-post

link: http://micahgilman.com/play/disable-mac-mailapp-inline-image-attachments/

content: |-

    > Mail.app by default displays images inline, and most email clients won’t
    > recognize them as attachments. If you right click (or ctrl click with a
    > one button mouse) on the image you can select to view the image as icon,
    > which makes it behave like a normal attachment. To make this the default
    > behavior you’ll need to use the Terminal to set the preference. Terminal
    > is in `Applications > Utilities`. Open Terminal and type:

    <pre class="brush: bash">
    defaults write com.apple.mail DisableInlineAttachmentViewing -bool yes
    </pre>

    If you decide this isn’t what you’re looking for, to restore inline attachment viewing type:

    <pre class="brush: bash">
    defaults write com.apple.mail DisableInlineAttachmentViewing -bool false
    </pre>

    Restart Mail and you’re back to normal.
